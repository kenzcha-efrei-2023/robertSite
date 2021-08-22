--
-- PostgreSQL database dump
--

-- Dumped from database version 11.9 (Raspbian 11.9-0+deb10u1)
-- Dumped by pg_dump version 11.9 (Raspbian 11.9-0+deb10u1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: logjour; Type: TABLE; Schema: public; Owner: pi
--

CREATE TABLE public.logjour (
    eau integer,
    etat integer,
    feed boolean,
    pet boolean,
    dat date NOT NULL
);


ALTER TABLE public.logjour OWNER TO pi;

--
-- Name: mesures; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mesures (
    eau integer,
    photoresistance1 integer,
    photoresistance2 integer,
    dat date,
    heure integer
);


ALTER TABLE public.mesures OWNER TO postgres;

--
-- Name: streak; Type: TABLE; Schema: public; Owner: pi
--

CREATE TABLE public.streak (
    dat_start date NOT NULL,
    val integer
);


ALTER TABLE public.streak OWNER TO pi;

--
-- Name: test; Type: TABLE; Schema: public; Owner: pi
--

CREATE TABLE public.test (
    nombre integer
);


ALTER TABLE public.test OWNER TO pi;

--
-- Name: users; Type: TABLE; Schema: public; Owner: pi
--

CREATE TABLE public.users (
    email text NOT NULL,
    pswd text,
    pseudo text
);


ALTER TABLE public.users OWNER TO pi;

--
-- Data for Name: logjour; Type: TABLE DATA; Schema: public; Owner: pi
--

COPY public.logjour (eau, etat, feed, pet, dat) FROM stdin;
100	2	t	f	2021-01-02
0	1	t	f	2021-01-13
0	1	t	f	2021-01-14
0	1	f	t	2021-01-15
\.


--
-- Data for Name: mesures; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mesures (eau, photoresistance1, photoresistance2, dat, heure) FROM stdin;
0	467	479	2021-01-07	18
0	568	537	2021-01-13	17
0	409	472	2021-01-07	19
0	539	480	2021-01-13	19
0	515	476	2021-01-07	20
447	148	204	2021-01-15	11
0	421	477	2021-01-07	17
0	164	112	2021-01-13	16
\.


--
-- Data for Name: streak; Type: TABLE DATA; Schema: public; Owner: pi
--

COPY public.streak (dat_start, val) FROM stdin;
2021-01-13	1
2020-12-01	16
\.


--
-- Data for Name: test; Type: TABLE DATA; Schema: public; Owner: pi
--

COPY public.test (nombre) FROM stdin;
1
8
0
19
7
4
8
3
8
5
8
8
3
19
5
8
0
1
6
7
7
2
19
8
5
1
2
7
2
2
3
3
19
9
9
9
2
4
7
5
19
1
3
5
6
3
9
5
5
2
6
0
19
7
19
8
5
6
5
5
7
4
8
9
2
4
4
19
3
19
19
6
8
8
4
3
2
2
0
0
19
4
7
4
1
6
1
5
4
4
5
2
3
2
7
3
2
7
7
2
4
4
4
2
5
4
6
0
5
4
9
6
1
1
4
2
6
9
1
3
5
6
5
1
3
3
7
0
3
0
19
2
2
6
1
0
8
8
19
4
9
3
5
7
2
2
6
1
3
9
3
2
1
2
7
2
0
0
7
7
1
9
7
8
2
6
7
4
9
3
6
7
1
1
7
6
0
19
1
6
7
0
8
9
6
1
3
9
7
6
8
19
2
5
8
3
1
4
4
5
0
9
3
4
9
7
6
7
7
7
8
19
3
1
3
2
7
5
6
8
3
8
1
19
1
3
3
4
5
2
2
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: pi
--

COPY public.users (email, pswd, pseudo) FROM stdin;
kenza.tazi@efrei.net	$2b$10$9r5Z4voBgdt1bzGVLdcvzO3QW5S/9szQh7TDPO8tz2jqmdpw5tKGi	kenza
\.


--
-- Name: logjour logjour_pkey; Type: CONSTRAINT; Schema: public; Owner: pi
--

ALTER TABLE ONLY public.logjour
    ADD CONSTRAINT logjour_pkey PRIMARY KEY (dat);


--
-- Name: streak streak_pkey; Type: CONSTRAINT; Schema: public; Owner: pi
--

ALTER TABLE ONLY public.streak
    ADD CONSTRAINT streak_pkey PRIMARY KEY (dat_start);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: pi
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (email);


--
-- Name: TABLE mesures; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.mesures TO pi;


--
-- PostgreSQL database dump complete
--

