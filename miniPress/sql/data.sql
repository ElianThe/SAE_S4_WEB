INSERT INTO `Users` (`email`, `password`, `role`, `name`) VALUES
                                                      ('admin@example.com', 'adminpassword', 'admin', 'Joe');

INSERT INTO `Categories` (`name`) VALUES
                                      ('Technology'),
                                      ('Science'),
                                      ('Art');

INSERT INTO `Articles` (`title`, `summary`, `content`, `cat_id`, `user_id`, `image_url`, `isPublished`, `published_at`) VALUES
                                                                                                                            ('The Future of AI', 'This article talks about the future of AI...', 'Long Content Here...', 1, 1, 'https://example.com/image1.jpg', 1, NOW()),
                                                                                                                            ('Understanding Quantum Physics', 'A deep dive into quantum physics...', 'Long Content Here...', 2, 1, 'https://example.com/image2.jpg', 1, NOW()),
                                                                                                                            ('Exploring Abstract Art', 'This article explores the essence of abstract art...', 'Long Content Here...', 3, 1, 'https://example.com/image3.jpg', 1, NOW()),
                                                                                                                            ('Artificial Intelligence in Medicine', 'This article discusses the use of AI in medicine...', 'Long Content Here...', 1, 1, 'https://example.com/image4.jpg', 1, NOW()),
                                                                                                                            ('Hidden Dimensions: String Theory', 'Exploring the hidden dimensions as per string theory...', 'Long Content Here...', 2, 1, 'https://example.com/image5.jpg', 1, NOW()),
                                                                                                                            ('Photography: Capturing Souls', 'An insight into portrait photography...', 'Long Content Here...', 3, 1, 'https://example.com/image6.jpg', 1, NOW()),
                                                                                                                            ('Unveiling the Secrets of AI', 'This article unveils the secrets of AI...', 'Long Content Here...', 1, 1, 'https://example.com/image7.jpg', 0, NULL),
                                                                                                                            ('Quantum Computing: A Leap Forward', 'Discussing the advances in quantum computing...', 'Long Content Here...', 2, 1, 'https://example.com/image8.jpg', 0, NULL);