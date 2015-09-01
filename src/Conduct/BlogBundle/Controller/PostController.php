<?php

namespace Conduct\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Conduct\BlogBundle\Entity\Post;
use Conduct\BlogBundle\Entity\Comment;
use Conduct\BlogBundle\Form\PostType;
use Conduct\BlogBundle\Form\CommentType;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{

    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        ///
        /*
        $post = new Post();
        $post->setTitle('testing');
        $post->setBody('this is the content');
        $date_time = new \DateTime();
        $post->setPostDate($date_time);

        $comment = new Comment();
        $comment->setAuthor('bill');
        $comment->setAuthorEmail('bob@bobbob.com');
        $comment->setAuthorUrl('http://author.com');
        $comment->setAuthorIp('394939');
        $comment->setDate($date_time);
        $comment->setContent('this is the comment content');
        $comment->setApproved(true);
        $comment->setType('huh');

        $comment->setPost($post);

        $em->persist($post);
        $em->persist($comment);
        $em->flush();
    */
        ///

        $entities = $em->getRepository('ConductBlogBundle:Post')->findAll();

        return $this->render('ConductBlogBundle:Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Post();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $date_time = new \DateTime();
            $entity->setPostDate($date_time);

            $entity->setPostStatus($entity::STATUS_OPEN);

            $entity->setPostModified($date_time);

            $entity->setUser($this->getUser());

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('title' => $entity->getPermalink())));
        }

        return $this->render('ConductBlogBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createcommentAction(Request $request)
    {


        $comment_data = $request->request->get('conduct_blogbundle_comment');
        $post_id = $comment_data['post_id'];
        //var_dump($post_id);
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('ConductBlogBundle:Post')->find($post_id);

        $entity = new Comment();
        $entity->setPost($post);
        $form = $this->createCommentForm($entity);

        $response['message'] = '';
        $response['markup'] = '';

        $form->handleRequest($request);

        if($form->isValid())
        {


            // get the post entity


            // set additional comment entity fields
            $entity->setAuthorIp('2343434343');

            $entity->setDate(new \DateTime());

            $entity->setApproved(true);

            $entity->setType('sometype');

            $entity->setPost($post);

            $em->persist($entity);
            $em->flush();

            $response['success'] = true;
            $response['markup'] = $this->render('ConductBlogBundle:Post:comment.html.twig',
                array('comment' => $entity))->getContent();
        }
        else
        {
            $response['success'] = false;
            $response['message'] = 'something failed to validate';
        }
        //return $this->redirect($this->generateUrl('post_show', array('title' => $post->getTitle())));
        return new JsonResponse($response);
    }

    /**
     * Creates a form to create a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    private function createCommentForm(Comment $entity)
    {
        $form = $this->createForm(new CommentType(), $entity, array(
            'action' => $this->generateUrl('comment_create'),
            'method' => 'POST',
        ));

        $form->add('post_id', 'hidden', array(
            'mapped' => false,
            'data' => $entity->getPost()->getId()
        ));
        $form->add('submit', 'submit', array('label' => 'Submit'));

        return $form;
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction()
    {
        $entity = new Post();
        $form   = $this->createCreateForm($entity);

        return $this->render('ConductBlogBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }



    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($title)
    {

        $em = $this->getDoctrine()->getManager();
        $title = str_replace('-', ' ', $title);

        $entity = $em->getRepository('ConductBlogBundle:Post')->findOneBy(array('title' => $title));
        $id = $entity->getId();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $comments = $em->getRepository('ConductBlogBundle:Comment')->findBy(array('post' => $id));

        $comment_entity = new Comment();
        $comment_entity->setPost($entity);
        $comment_form = $this->createCommentForm($comment_entity);

       

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ConductBlogBundle:Post:show.html.twig', array(
            'entity'      => $entity,
            'comments'    => $comments,
            'delete_form' => $deleteForm->createView(),
            'comment_form' => $comment_form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ConductBlogBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ConductBlogBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ConductBlogBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
        }

        return $this->render('ConductBlogBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ConductBlogBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
