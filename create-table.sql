create table [dbo].[User](
    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY(id),
    nama VARCHAR(30),
    email VARCHAR(30),
    devclass VARCHAR(30),
    favlang VARCHAR(30)
);