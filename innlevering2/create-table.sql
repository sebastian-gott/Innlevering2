CREATE TABLE klasse (
klassekode VARCHAR (4) NOT NULL,
klassenavn VARCHAR (30) NOT NULL,
studiumkode VARCHAR (5) NOT NULL,
PRIMARY KEY (klassekode)
);

CREATE TABLE bilde (
    bildenr CHAR (4) NOT NULL,
    opplastningsdato DATE NOT NULL,
    filnavn VARCHAR (30) NOT NULL,
    beskrivelse CHAR (30) NOT NULL,
    PRIMARY KEY (bildenr)
);

CREATE TABLE student (
brukernavn CHAR(4) NOT NULL,
fornavn  VARCHAR (30) NOT NULL,
etternavn VARCHAR (30) NOT NULL,
klassekode VARCHAR (4) NULL,
bildenr CHAR (4) NOT NULL,
PRIMARY KEY (brukernavn),
FOREIGN KEY (klassekode) REFERENCES klasse(klassekode),
FOREIGN KEY (bildenr) REFERENCES bilde(bildenr)
);

CREATE TABLE bruker (
    brukernavn CHAR(10) NOT NULL,
    passord VARCHAR(30) NOT NULL
);