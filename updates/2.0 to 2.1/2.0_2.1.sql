ALTER TABLE `blog` ADD `blog_uploader_type` VARCHAR(20) NOT NULL DEFAULT 'user';
ALTER TABLE `blog_photo` ADD `blog_photo_uploader_type` VARCHAR(20) NOT NULL DEFAULT 'user';
ALTER TABLE `blog_video` ADD `blog_video_uploader_type` VARCHAR(20) NOT NULL DEFAULT 'user';

INSERT INTO `permission` (`permission_id`, `name`, `codename`, `parent_status`) VALUES
(108, 'Blog Post', 'blog_post' , 'parent');
