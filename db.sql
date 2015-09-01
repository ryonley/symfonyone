--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE comment (
    id integer NOT NULL,
    post_id integer,
    author character varying(255) NOT NULL,
    author_email character varying(255) NOT NULL,
    author_url character varying(255) NOT NULL,
    author_ip character varying(100) NOT NULL,
    date timestamp(0) without time zone NOT NULL,
    content text NOT NULL,
    approved boolean NOT NULL,
    type character varying(20) NOT NULL
);


ALTER TABLE comment OWNER TO root;

--
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE comment_id_seq OWNER TO root;

--
-- Name: fos_user; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE fos_user (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    username_canonical character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_canonical character varying(255) NOT NULL,
    enabled boolean NOT NULL,
    salt character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    locked boolean NOT NULL,
    expired boolean NOT NULL,
    expires_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    confirmation_token character varying(255) DEFAULT NULL::character varying,
    password_requested_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles text NOT NULL,
    credentials_expired boolean NOT NULL,
    credentials_expire_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE fos_user OWNER TO root;

--
-- Name: COLUMN fos_user.roles; Type: COMMENT; Schema: public; Owner: root
--

COMMENT ON COLUMN fos_user.roles IS '(DC2Type:array)';


--
-- Name: fos_user_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE fos_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE fos_user_id_seq OWNER TO root;

--
-- Name: migration_versions; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE migration_versions (
    version character varying(255) NOT NULL
);


ALTER TABLE migration_versions OWNER TO root;

--
-- Name: post; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE post (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    content text NOT NULL,
    post_date timestamp(0) without time zone NOT NULL,
    post_excerpt character varying(255) NOT NULL,
    post_status integer NOT NULL,
    post_modified timestamp(0) without time zone NOT NULL,
    postauthor_id integer
);


ALTER TABLE post OWNER TO root;

--
-- Name: post_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE post_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE post_id_seq OWNER TO root;

--
-- Name: postmeta; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE postmeta (
    id integer NOT NULL,
    post_id integer,
    meta_key character varying(255) NOT NULL,
    meta_value character varying(255) NOT NULL
);


ALTER TABLE postmeta OWNER TO root;

--
-- Name: postmeta_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE postmeta_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE postmeta_id_seq OWNER TO root;

--
-- Name: product; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE product (
    id integer NOT NULL,
    name text NOT NULL,
    price numeric(10,2) NOT NULL,
    description text NOT NULL,
    model text NOT NULL
);


ALTER TABLE product OWNER TO root;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE product_id_seq OWNER TO postgres;

--
-- Name: thing; Type: TABLE; Schema: public; Owner: root; Tablespace: 
--

CREATE TABLE thing (
    id integer NOT NULL,
    info character varying(255) NOT NULL
);


ALTER TABLE thing OWNER TO root;

--
-- Name: thing_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE thing_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE thing_id_seq OWNER TO root;

--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: root
--

COPY comment (id, post_id, author, author_email, author_url, author_ip, date, content, approved, type) FROM stdin;
2	1	Bill	Bill@somesite.com	http://somesite.com	2343434343	2015-08-03 01:49:40	this post sucks	t	sometype
\.


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('comment_id_seq', 2, true);


--
-- Data for Name: fos_user; Type: TABLE DATA; Schema: public; Owner: root
--

COPY fos_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at) FROM stdin;
1	Rodger	rodger	ryonley@gmail.com	ryonley@gmail.com	t	6q0z1lrzu9kwgwk48c4cwsswoko8kcw	5P84WWmEIDX+6nfkkFqmhTwBh7BqtGYCZXtyJjFaDBh9wUDmiBl1XaEOO54eOZZ9eFnoS9Yui5idzZ8cpjAorQ==	2015-08-03 01:32:22	f	f	\N	\N	\N	a:1:{i:0;s:10:"ROLE_ADMIN";}	f	\N
\.


--
-- Name: fos_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('fos_user_id_seq', 1, true);


--
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: root
--

COPY migration_versions (version) FROM stdin;
20150301193906
20150301194812
20150302013406
20150307223935
20150308000900
20150309005842
20150309011715
20150309012403
20150315214524
20150317233948
20150317234310
20150323000545
20150803021313
20150817024559
\.


--
-- Data for Name: post; Type: TABLE DATA; Schema: public; Owner: root
--

COPY post (id, title, content, post_date, post_excerpt, post_status, post_modified, postauthor_id) FROM stdin;
1	test post 1	this is only a test	2015-07-24 05:32:27	testing testing testing	1	2015-07-24 05:32:27	1
\.


--
-- Name: post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('post_id_seq', 1, true);


--
-- Data for Name: postmeta; Type: TABLE DATA; Schema: public; Owner: root
--

COPY postmeta (id, post_id, meta_key, meta_value) FROM stdin;
\.


--
-- Name: postmeta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('postmeta_id_seq', 1, false);


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: root
--

COPY product (id, name, price, description, model) FROM stdin;
\.


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('product_id_seq', 1, false);


--
-- Data for Name: thing; Type: TABLE DATA; Schema: public; Owner: root
--

COPY thing (id, info) FROM stdin;
\.


--
-- Name: thing_id_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('thing_id_seq', 1, false);


--
-- Name: comment_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (id);


--
-- Name: fos_user_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY fos_user
    ADD CONSTRAINT fos_user_pkey PRIMARY KEY (id);


--
-- Name: migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY migration_versions
    ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);


--
-- Name: post_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY post
    ADD CONSTRAINT post_pkey PRIMARY KEY (id);


--
-- Name: postmeta_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY postmeta
    ADD CONSTRAINT postmeta_pkey PRIMARY KEY (id);


--
-- Name: product_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY product
    ADD CONSTRAINT product_pkey PRIMARY KEY (id);


--
-- Name: thing_pkey; Type: CONSTRAINT; Schema: public; Owner: root; Tablespace: 
--

ALTER TABLE ONLY thing
    ADD CONSTRAINT thing_pkey PRIMARY KEY (id);


--
-- Name: idx_3aa8e2ea4b89032c; Type: INDEX; Schema: public; Owner: root; Tablespace: 
--

CREATE INDEX idx_3aa8e2ea4b89032c ON postmeta USING btree (post_id);


--
-- Name: idx_5bc96bf04b89032c; Type: INDEX; Schema: public; Owner: root; Tablespace: 
--

CREATE INDEX idx_5bc96bf04b89032c ON comment USING btree (post_id);


--
-- Name: idx_fab8c3b3e5a9bd79; Type: INDEX; Schema: public; Owner: root; Tablespace: 
--

CREATE INDEX idx_fab8c3b3e5a9bd79 ON post USING btree (postauthor_id);


--
-- Name: uniq_957a647992fc23a8; Type: INDEX; Schema: public; Owner: root; Tablespace: 
--

CREATE UNIQUE INDEX uniq_957a647992fc23a8 ON fos_user USING btree (username_canonical);


--
-- Name: uniq_957a6479a0d96fbf; Type: INDEX; Schema: public; Owner: root; Tablespace: 
--

CREATE UNIQUE INDEX uniq_957a6479a0d96fbf ON fos_user USING btree (email_canonical);


--
-- Name: fk_3aa8e2ea4b89032c; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY postmeta
    ADD CONSTRAINT fk_3aa8e2ea4b89032c FOREIGN KEY (post_id) REFERENCES post(id);


--
-- Name: fk_5bc96bf04b89032c; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT fk_5bc96bf04b89032c FOREIGN KEY (post_id) REFERENCES post(id);


--
-- Name: fk_fab8c3b3e5a9bd79; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY post
    ADD CONSTRAINT fk_fab8c3b3e5a9bd79 FOREIGN KEY (postauthor_id) REFERENCES fos_user(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

