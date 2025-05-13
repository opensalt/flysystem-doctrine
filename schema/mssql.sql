create table flysystem_files
(
    id         bigint identity primary key,
    path       nvarchar(255)                not null,
    type       nvarchar(4)                  not null,
    contents   varbinary(max),
    size       int         default 0        not null,
    level      int                          not null,
    mimetype   nvarchar(127),
    visibility nvarchar(7) default 'public' not null,
    timestamp  int         default 0        not null
);
