DROP TABLE IF EXISTS Articles;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Users;

CREATE TABLE Users
(
    ID       INT AUTO_INCREMENT PRIMARY KEY,
    Email    VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role     ENUM('admin', 'editor') NOT NULL DEFAULT 'editor'
);

CREATE TABLE Categories
(
    ID   INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL
);

CREATE TABLE Articles
(
    ID           INT AUTO_INCREMENT PRIMARY KEY,
    Title        VARCHAR(255) NOT NULL,
    Summary      TEXT,
    Content      TEXT         NOT NULL,
    DateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,
    Category_ID  INT,
    User_ID      INT,
    Image_URL    VARCHAR(512),
    IsPublished  BOOLEAN  DEFAULT 0,
    FOREIGN KEY (Category_ID) REFERENCES Categories (ID),
    FOREIGN KEY (User_ID) REFERENCES Users (ID)
);
