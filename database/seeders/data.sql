-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table rezas_ecommerce.blogs: ~3 rows (approximately)
DELETE FROM `blogs`;
INSERT INTO `blogs` (`id`, `title`, `slug`, `image_url`, `info`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'First Blog', 'first-blog', 'img/blog/blog-1.jpg', 'This is the first blog post.', 'This is the first blog post.', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(2, 'Second Blog', 'second-blog', 'img/blog/blog-2.jpg', 'This is the first blog post.', 'This is the second blog post.', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(3, 'Third Blog', 'third-blog', 'img/blog/blog-3.jpg', 'This is the first blog post.', 'This is the second blog post.', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(4, 'Test add blog', 'test-add-blog', 'img/blog/test-add-blog.jpg', 'A blog post is any article thats published', '<p>If you&rsquo;ve ever read a blog post, you&rsquo;ve consumed content from a thought leader that is an expert in their industry. Chances are if the blog post was written effectively, you came away with helpful knowledge and a positive opinion about the writer or brand that produced the content.</p>\r\n<p>Anyone can connect with their audience through blogging and enjoy the myriad benefits that blogging provides: organic traffic from search engines, promotional content for social media, and recognition from a new audience you haven&rsquo;t tapped into yet.</p>\r\n<p><span data-sheets-value="{&quot;1&quot;:2,&quot;2&quot;:&quot;If you&rsquo;ve heard about blogging but are a beginner and don&rsquo;t know where to start, the time for excuses is over. Not only can you create an SEO-friendly blog, but we&rsquo;ll cover how to write and manage your business\'s blog as well as provide helpful templates to simplify your blogging efforts.&quot;}" data-sheets-userformat="{&quot;2&quot;:1059713,&quot;3&quot;:{&quot;1&quot;:0},&quot;10&quot;:1,&quot;11&quot;:4,&quot;12&quot;:0,&quot;14&quot;:{&quot;1&quot;:2,&quot;2&quot;:3032925},&quot;16&quot;:10,&quot;23&quot;:1}" data-sheets-textstyleruns="{&quot;1&quot;:0}{&quot;1&quot;:128,&quot;2&quot;:{&quot;2&quot;:{&quot;1&quot;:2,&quot;2&quot;:1136076},&quot;9&quot;:1}}{&quot;1&quot;:155}" data-sheets-hyperlinkruns="{&quot;1&quot;:128,&quot;2&quot;:&quot;https://www.hubspot.com/products/cms/free-blog-maker&quot;}{&quot;1&quot;:155}">If you&rsquo;ve heard about blogging but are a beginner and don&rsquo;t know where to start, the time for excuses is over. Not only can you&nbsp;<a href="https://www.hubspot.com/products/cms/free-blog-maker?hubs_content=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_content-cta=create%20an%20SEO-friendly%20blog&amp;hubs_post=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_post-cta=create%20an%20SEO-friendly%20blog" target="_blank" rel="noopener">create an SEO-friendly blog</a>, but we&rsquo;ll cover how to write and manage your business\'s blog as well as provide helpful templates to simplify your blogging efforts.</span></p>\r\n<p>Let\'s get started with an important question.</p>\r\n<p>Blogging may mean different things depending on your niche &mdash; so let&rsquo;s begin with this definition.</p>\r\n<h2>What is a blog post?</h2>\r\n<p>A blog post is any article, news piece, or guide that\'s published in the blog section of a website. A blog post typically covers a specific topic or query, is educational in nature, ranges from 600 to 2,000+ words, and contains other media types such as images, videos, infographics, and interactive charts.</p>\r\n<p>Blog posts allow you and your business to publish insights, thoughts, and stories on your website about any topic. They can help you boost brand awareness, credibility, conversions, and revenue. Most importantly, they can help you drive traffic to your website.</p>\r\n<p>But in order to begin making posts for a blog &mdash; you have to learn how to start one, first. Let&rsquo;s dive in.</p>\r\n<p>&nbsp;</p>\r\n<h3>1. Understand your audience</h3>\r\n<p>Before you start writing your blog post, make sure you have a clear understanding of your target audience. To do so, take the following steps.</p>\r\n<h4>Ask yourself exploratory questions.</h4>\r\n<p>To discover your audience, ask questions like: Who are they? Are they like me, or do I know someone like them? What do they want to know about? What will resonate with them?</p>\r\n<p>Jot down your notes in a notepad or a document. This is the time to brainstorm audience attributes from scratch, no matter how out of left field they may feel. You should also think about your audience\'s age, background, goals, and challenges at this stage.</p>\r\n<h4>Carry out market research.</h4>\r\n<p><a href="https://blog.hubspot.com/marketing/market-research-buyers-journey-guide?hubs_content=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_content-cta=Doing%20market%20research" target="_blank" rel="noopener">Doing market research</a>&nbsp;sounds like a big task, but in truth, it can be as simple as accessing a social media platform and browsing user and blog profiles that match with your potential audience.</p>\r\n<p>Use&nbsp;<a href="https://blog.hubspot.com/marketing/market-research-tools-resources?hubs_content=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_content-cta=market%20research%20tools" target="_blank" rel="noopener">market research tools</a> to begin uncovering more specific information about your audience &mdash; or to confirm a hunch or a piece of information you already knew. For instance, if you wanted to create a blog about work-from-home hacks, you can make the reasonable assumption that your audience will be mostly Gen Zers and Millennials. But it&rsquo;s important to confirm this information through research.</p>', '2023-07-12 07:07:07', '2023-07-12 08:17:13');

-- Dumping data for table rezas_ecommerce.categories: ~4 rows (approximately)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `category`, `slug`, `thumbnail`, `created_at`, `updated_at`) VALUES
	(1, 'Makanan', 'makanan', 'img/categories/cat-1.jpg', '2023-06-26 22:43:38', '2023-07-12 07:23:20'),
	(2, 'Minuman', 'minuman', 'img/categories/cat-2.jpg', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(3, 'Snack', 'snack', 'img/categories/cat-3.jpg', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(4, 'Buah-buahan', 'buah-buahan', 'img/categories/cat-4.jpg', '2023-06-26 22:43:38', '2023-06-26 22:43:38');

-- Dumping data for table rezas_ecommerce.couriers: ~2 rows (approximately)
DELETE FROM `couriers`;
INSERT INTO `couriers` (`id`, `code`, `courier_name`, `created_at`, `updated_at`) VALUES
	(1, 'gojek', 'Gojek', '2023-06-29 23:02:33', '2023-06-29 23:02:33'),
	(2, 'grab', 'Grab', '2023-06-29 23:02:33', '2023-06-29 23:02:33');

-- Dumping data for table rezas_ecommerce.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping data for table rezas_ecommerce.featured_products: ~8 rows (approximately)
DELETE FROM `featured_products`;
INSERT INTO `featured_products` (`id`, `product_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(2, 3, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(3, 4, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(4, 8, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(5, 9, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(6, 12, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(7, 18, '2023-07-12 09:21:02', '2023-07-12 09:21:02'),
	(8, 27, '2023-07-12 09:21:02', '2023-07-12 09:21:02');

-- Dumping data for table rezas_ecommerce.members: ~0 rows (approximately)
DELETE FROM `members`;
INSERT INTO `members` (`id`, `user_id`, `name`, `address`, `phone`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Samuel Septa Munthe', 'Jalan Palangka Raya', '082252961155', '-2.2142566506905155', '113.90092947082178', '2023-06-27 01:25:19', '2023-06-27 18:36:46');

-- Dumping data for table rezas_ecommerce.migrations: ~20 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_05_27_001014_create_permission_tables', 1),
	(6, '2023_05_27_001435_create_transactions_table', 1),
	(7, '2023_05_27_003023_create_transaction_details_table', 1),
	(8, '2023_05_27_003232_create_products_table', 1),
	(9, '2023_05_27_003844_create_categories_table', 1),
	(10, '2023_05_27_005318_create_shopping_carts_table', 1),
	(11, '2023_05_27_005439_create_shops_table', 1),
	(12, '2023_05_27_010806_create_vouchers_table', 1),
	(13, '2023_05_27_010940_create_blogs_table', 1),
	(14, '2023_05_27_011058_create_members_table', 1),
	(15, '2023_05_29_084710_create_featured_products_table', 1),
	(16, '2023_05_31_065255_create_wishlists_table', 1),
	(17, '2023_06_30_055934_create_couriers_table', 2),
	(18, '2023_07_03_082446_create_payment_methods_table', 3),
	(19, '2023_07_03_093452_create_voucher_logs_table', 4),
	(20, '2023_07_13_091319_create_shipping_logs_table', 5);

-- Dumping data for table rezas_ecommerce.model_has_permissions: ~0 rows (approximately)
DELETE FROM `model_has_permissions`;

-- Dumping data for table rezas_ecommerce.model_has_roles: ~5 rows (approximately)
DELETE FROM `model_has_roles`;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(2, 'App\\Models\\User', 4),
	(4, 'App\\Models\\User', 5);

-- Dumping data for table rezas_ecommerce.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;

-- Dumping data for table rezas_ecommerce.payment_methods: ~4 rows (approximately)
DELETE FROM `payment_methods`;
INSERT INTO `payment_methods` (`id`, `code`, `icon_url`, `created_at`, `updated_at`) VALUES
	(1, 'bca_va', 'img/payment/bca-icon.png', '2023-07-03 08:34:15', '2023-07-03 08:34:16'),
	(2, 'bri_va', 'img/payment/bri-icon.png', '2023-07-03 08:34:15', '2023-07-03 08:34:16'),
	(3, 'other_qris', 'img/payment/qris.png', '2023-07-03 08:34:15', '2023-07-03 08:34:16'),
	(4, 'indomaret', 'img/payment/indomaret.png', '2023-07-03 08:34:15', '2023-07-03 08:34:16');

-- Dumping data for table rezas_ecommerce.permissions: ~0 rows (approximately)
DELETE FROM `permissions`;

-- Dumping data for table rezas_ecommerce.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping data for table rezas_ecommerce.products: ~101 rows (approximately)
DELETE FROM `products`;
INSERT INTO `products` (`id`, `category_id`, `shop_id`, `product_name`, `image_url`, `slug`, `description`, `price`, `discount`, `stock`, `total_sold`, `status`, `created_at`, `updated_at`) VALUES
	(1, 4, 2, 'Product 1', 'img/product/product-details-4.jpg', 'product-1', 'Description of Product 1', 103793.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(2, 1, 2, 'Product 2', 'img/product/product-details-1.jpg', 'product-2', 'Description of Product 2', 245425.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(3, 2, 3, 'Product 3', 'img/product/product-details-2.jpg', 'product-3', 'Description of Product 3', 202449.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(4, 4, 1, 'Product Keempat', 'img/product/product-details-4.jpg', 'product-keempat', '<p>If you&rsquo;ve ever read a blog post, you&rsquo;ve consumed content from a thought leader that is an expert in their industry. Chances are if the blog post was written effectively, you came away with helpful knowledge and a positive opinion about the writer or brand that produced the content.</p>\r\n<p>Anyone can connect with their audience through blogging and enjoy the myriad benefits that blogging provides: organic traffic from search engines, promotional content for social media, and recognition from a new audience you haven&rsquo;t tapped into yet.</p>\r\n<p><span data-sheets-value="{&quot;1&quot;:2,&quot;2&quot;:&quot;If you&rsquo;ve heard about blogging but are a beginner and don&rsquo;t know where to start, the time for excuses is over. Not only can you create an SEO-friendly blog, but we&rsquo;ll cover how to write and manage your business\'s blog as well as provide helpful templates to simplify your blogging efforts.&quot;}" data-sheets-userformat="{&quot;2&quot;:1059713,&quot;3&quot;:{&quot;1&quot;:0},&quot;10&quot;:1,&quot;11&quot;:4,&quot;12&quot;:0,&quot;14&quot;:{&quot;1&quot;:2,&quot;2&quot;:3032925},&quot;16&quot;:10,&quot;23&quot;:1}" data-sheets-textstyleruns="{&quot;1&quot;:0}{&quot;1&quot;:128,&quot;2&quot;:{&quot;2&quot;:{&quot;1&quot;:2,&quot;2&quot;:1136076},&quot;9&quot;:1}}{&quot;1&quot;:155}" data-sheets-hyperlinkruns="{&quot;1&quot;:128,&quot;2&quot;:&quot;https://www.hubspot.com/products/cms/free-blog-maker&quot;}{&quot;1&quot;:155}">If you&rsquo;ve heard about blogging but are a beginner and don&rsquo;t know where to start, the time for excuses is over. Not only can you&nbsp;<a href="https://www.hubspot.com/products/cms/free-blog-maker?hubs_content=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_content-cta=create%20an%20SEO-friendly%20blog&amp;hubs_post=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_post-cta=create%20an%20SEO-friendly%20blog" target="_blank" rel="noopener">create an SEO-friendly blog</a>, but we&rsquo;ll cover how to write and manage your business\'s blog as well as provide helpful templates to simplify your blogging efforts.</span></p>\r\n<p>Let\'s get started with an important question.</p>\r\n<p>Blogging may mean different things depending on your niche &mdash; so let&rsquo;s begin with this definition.</p>\r\n<h2>What is a blog post?</h2>\r\n<p>A blog post is any article, news piece, or guide that\'s published in the blog section of a website. A blog post typically covers a specific topic or query, is educational in nature, ranges from 600 to 2,000+ words, and contains other media types such as images, videos, infographics, and interactive charts.</p>\r\n<p>Blog posts allow you and your business to publish insights, thoughts, and stories on your website about any topic. They can help you boost brand awareness, credibility, conversions, and revenue. Most importantly, they can help you drive traffic to your website.</p>\r\n<p>But in order to begin making posts for a blog &mdash; you have to learn how to start one, first. Let&rsquo;s dive in.</p>\r\n<p>&nbsp;</p>\r\n<h3>1. Understand your audience</h3>\r\n<p>Before you start writing your blog post, make sure you have a clear understanding of your target audience. To do so, take the following steps.</p>\r\n<h4>Ask yourself exploratory questions.</h4>\r\n<p>To discover your audience, ask questions like: Who are they? Are they like me, or do I know someone like them? What do they want to know about? What will resonate with them?</p>\r\n<p>Jot down your notes in a notepad or a document. This is the time to brainstorm audience attributes from scratch, no matter how out of left field they may feel. You should also think about your audience\'s age, background, goals, and challenges at this stage.</p>\r\n<h4>Carry out market research.</h4>\r\n<p><a href="https://blog.hubspot.com/marketing/market-research-buyers-journey-guide?hubs_content=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_content-cta=Doing%20market%20research" target="_blank" rel="noopener">Doing market research</a>&nbsp;sounds like a big task, but in truth, it can be as simple as accessing a social media platform and browsing user and blog profiles that match with your potential audience.</p>\r\n<p>Use&nbsp;<a href="https://blog.hubspot.com/marketing/market-research-tools-resources?hubs_content=blog.hubspot.com/marketing/how-to-start-a-blog&amp;hubs_content-cta=market%20research%20tools" target="_blank" rel="noopener">market research tools</a> to begin uncovering more specific information about your audience &mdash; or to confirm a hunch or a piece of information you already knew. For instance, if you wanted to create a blog about work-from-home hacks, you can make the reasonable assumption that your audience will be mostly Gen Zers and Millennials. But it&rsquo;s important to confirm this information through research.</p>', 139886.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 23:34:25'),
	(5, 4, 1, 'Product 5', 'img/product/product-details-4.jpg', 'product-5', '<p>Jual Bika Ambon asli yang bakalan bikin kangen. Kuenya dibuat dengan menggunakan resep otentik khas Medan yang dijamin kenikmatan rasa dan teksturnya. Rasa manis yang pas dipadu dengan tekstur kue yang lembut menjadikan kue ini pasti bikin nagih.</p>\r\n<ul>\r\n<li>Fresh from the oven</li>\r\n<li>Hanya menggunakan bahan baku premium</li>\r\n<li>Rasa manis kue yang pas dan lembut</li>\r\n<li>Tahan 3 hari di luar kulkas dan 1 minggu di dalam kulkas</li>\r\n</ul>', 35240.00, 5.00, 97, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-07-12 05:41:38'),
	(6, 1, 3, 'Product 6', 'img/product/product-details-1.jpg', 'product-6', 'Description of Product 6', 109803.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(7, 2, 2, 'Product 7', 'img/product/product-details-2.jpg', 'product-7', 'Description of Product 7', 175765.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(8, 3, 1, 'Product 8', 'img/product/product-details-3.jpg', 'product-8', 'Description of Product 8', 99677.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(9, 3, 1, 'Product 9', 'img/product/product-details-3.jpg', 'product-9', 'Description of Product 9', 165508.00, NULL, 99, 1, 'PUBLISH', '2023-06-26 22:43:38', '2023-07-12 05:47:36'),
	(10, 1, 3, 'Product 10', 'img/product/product-details-1.jpg', 'product-10', 'Description of Product 10', 210219.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(11, 3, 1, 'Product 11', 'img/product/product-details-3.jpg', 'product-11', 'Description of Product 11', 168996.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(12, 2, 1, 'Product 12', 'img/product/product-details-2.jpg', 'product-12', 'Description of Product 12', 67495.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(13, 2, 1, 'Product 13', 'img/product/product-details-2.jpg', 'product-13', 'Description of Product 13', 112035.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(14, 3, 3, 'Product 14', 'img/product/product-details-3.jpg', 'product-14', 'Description of Product 14', 26933.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(15, 3, 3, 'Product 15', 'img/product/product-details-3.jpg', 'product-15', 'Description of Product 15', 119486.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(16, 2, 3, 'Product 16', 'img/product/product-details-2.jpg', 'product-16', 'Description of Product 16', 246029.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(17, 4, 1, 'Product 17', 'img/product/product-details-4.jpg', 'product-17', 'Description of Product 17', 228547.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(18, 3, 1, 'Product 18', 'img/product/product-details-3.jpg', 'product-18', 'Description of Product 18', 224891.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(19, 3, 1, 'Product 19', 'img/product/product-details-3.jpg', 'product-19', 'Description of Product 19', 120279.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(20, 1, 1, 'Product 20', 'img/product/product-details-1.jpg', 'product-20', 'Description of Product 20', 225971.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(21, 3, 2, 'Product 21', 'img/product/product-details-3.jpg', 'product-21', 'Description of Product 21', 108034.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(22, 4, 1, 'Product 22', 'img/product/product-details-4.jpg', 'product-22', 'Description of Product 22', 26512.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(23, 2, 2, 'Product 23', 'img/product/product-details-2.jpg', 'product-23', 'Description of Product 23', 99334.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(24, 1, 2, 'Product 24', 'img/product/product-details-1.jpg', 'product-24', 'Description of Product 24', 95973.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(25, 1, 3, 'Product 25', 'img/product/product-details-1.jpg', 'product-25', 'Description of Product 25', 179803.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(26, 1, 1, 'Product 26', 'img/product/product-details-1.jpg', 'product-26', 'Description of Product 26', 205941.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(27, 3, 2, 'Product 27', 'img/product/product-details-3.jpg', 'product-27', 'Description of Product 27', 68457.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(28, 1, 1, 'Product 28', 'img/product/product-details-1.jpg', 'product-28', 'Description of Product 28', 44784.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(29, 4, 1, 'Product 29', 'img/product/product-details-4.jpg', 'product-29', 'Description of Product 29', 179422.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(30, 2, 1, 'Product 30', 'img/product/product-details-2.jpg', 'product-30', 'Description of Product 30', 95528.00, NULL, 98, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-07-06 08:15:05'),
	(31, 4, 3, 'Product 31', 'img/product/product-details-4.jpg', 'product-31', 'Description of Product 31', 163669.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(32, 4, 2, 'Product 32', 'img/product/product-details-4.jpg', 'product-32', 'Description of Product 32', 90526.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(33, 2, 1, 'Product 33', 'img/product/product-details-2.jpg', 'product-33', 'Description of Product 33', 117923.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(34, 2, 1, 'Product 34', 'img/product/product-details-2.jpg', 'product-34', 'Description of Product 34', 248501.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(35, 4, 1, 'Product 35', 'img/product/product-details-4.jpg', 'product-35', 'Description of Product 35', 16325.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(36, 2, 3, 'Product 36', 'img/product/product-details-2.jpg', 'product-36', 'Description of Product 36', 111320.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(37, 4, 2, 'Product 37', 'img/product/product-details-4.jpg', 'product-37', 'Description of Product 37', 61893.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(38, 4, 3, 'Product 38', 'img/product/product-details-4.jpg', 'product-38', 'Description of Product 38', 91687.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(39, 2, 1, 'Product 39', 'img/product/product-details-2.jpg', 'product-39', 'Description of Product 39', 149926.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(40, 4, 1, 'Product 40', 'img/product/product-details-4.jpg', 'product-40', 'Description of Product 40', 118125.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(41, 3, 2, 'Product 41', 'img/product/product-details-3.jpg', 'product-41', 'Description of Product 41', 205103.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(42, 1, 2, 'Product 42', 'img/product/product-details-1.jpg', 'product-42', 'Description of Product 42', 138810.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(43, 1, 1, 'Product 43', 'img/product/product-details-1.jpg', 'product-43', 'Description of Product 43', 40149.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(44, 4, 2, 'Product 44', 'img/product/product-details-4.jpg', 'product-44', 'Description of Product 44', 238099.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(45, 2, 3, 'Product 45', 'img/product/product-details-2.jpg', 'product-45', 'Description of Product 45', 140106.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(46, 3, 1, 'Product 46', 'img/product/product-details-3.jpg', 'product-46', 'Description of Product 46', 242382.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(47, 4, 1, 'Product 47', 'img/product/product-details-4.jpg', 'product-47', 'Description of Product 47', 103957.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(48, 1, 1, 'Product 48', 'img/product/product-details-1.jpg', 'product-48', 'Description of Product 48', 179501.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(49, 3, 2, 'Product 49', 'img/product/product-details-3.jpg', 'product-49', 'Description of Product 49', 197860.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(50, 4, 1, 'Product 50', 'img/product/product-details-4.jpg', 'product-50', 'Description of Product 50', 162429.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(51, 2, 2, 'Product 51', 'img/product/product-details-2.jpg', 'product-51', 'Description of Product 51', 239498.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(52, 1, 1, 'Product 52', 'img/product/product-details-1.jpg', 'product-52', 'Description of Product 52', 234533.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(53, 2, 3, 'Product 53', 'img/product/product-details-2.jpg', 'product-53', 'Description of Product 53', 156094.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(54, 1, 1, 'Product 54', 'img/product/product-details-1.jpg', 'product-54', 'Description of Product 54', 175766.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(55, 4, 3, 'Product 55', 'img/product/product-details-4.jpg', 'product-55', 'Description of Product 55', 196023.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(56, 1, 1, 'Product 56', 'img/product/product-details-1.jpg', 'product-56', 'Description of Product 56', 87512.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(57, 3, 1, 'Product 57', 'img/product/product-details-3.jpg', 'product-57', 'Description of Product 57', 36747.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(58, 2, 2, 'Product 58', 'img/product/product-details-2.jpg', 'product-58', 'Description of Product 58', 61520.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(59, 1, 2, 'Product 59', 'img/product/product-details-1.jpg', 'product-59', 'Description of Product 59', 49754.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(60, 4, 1, 'Product 60', 'img/product/product-details-4.jpg', 'product-60', 'Description of Product 60', 129246.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(61, 3, 3, 'Product 61', 'img/product/product-details-3.jpg', 'product-61', 'Description of Product 61', 201727.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(62, 1, 3, 'Product 62', 'img/product/product-details-1.jpg', 'product-62', 'Description of Product 62', 233699.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(63, 1, 3, 'Product 63', 'img/product/product-details-1.jpg', 'product-63', 'Description of Product 63', 124140.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(64, 1, 2, 'Product 64', 'img/product/product-details-1.jpg', 'product-64', 'Description of Product 64', 68676.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(65, 1, 2, 'Product 65', 'img/product/product-details-1.jpg', 'product-65', 'Description of Product 65', 208847.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(66, 4, 3, 'Product 66', 'img/product/product-details-4.jpg', 'product-66', 'Description of Product 66', 65124.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(67, 2, 2, 'Product 67', 'img/product/product-details-2.jpg', 'product-67', 'Description of Product 67', 53364.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(68, 3, 1, 'Product 68', 'img/product/product-details-3.jpg', 'product-68', 'Description of Product 68', 245553.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(69, 4, 3, 'Product 69', 'img/product/product-details-4.jpg', 'product-69', 'Description of Product 69', 66908.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(70, 4, 1, 'Product 70', 'img/product/product-details-4.jpg', 'product-70', 'Description of Product 70', 55488.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(71, 4, 1, 'Product 71', 'img/product/product-details-4.jpg', 'product-71', 'Description of Product 71', 36124.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(72, 3, 3, 'Product 72', 'img/product/product-details-3.jpg', 'product-72', 'Description of Product 72', 114449.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(73, 3, 1, 'Product 73', 'img/product/product-details-3.jpg', 'product-73', 'Description of Product 73', 170442.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(74, 4, 2, 'Product 74', 'img/product/product-details-4.jpg', 'product-74', 'Description of Product 74', 208773.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(75, 2, 3, 'Product 75', 'img/product/product-details-2.jpg', 'product-75', 'Description of Product 75', 148604.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(76, 3, 2, 'Product 76', 'img/product/product-details-3.jpg', 'product-76', 'Description of Product 76', 24573.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(77, 4, 3, 'Product 77', 'img/product/product-details-4.jpg', 'product-77', 'Description of Product 77', 194858.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(78, 1, 3, 'Product 78', 'img/product/product-details-1.jpg', 'product-78', 'Description of Product 78', 136062.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(79, 2, 2, 'Product 79', 'img/product/product-details-2.jpg', 'product-79', 'Description of Product 79', 233346.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(80, 4, 3, 'Product 80', 'img/product/product-details-4.jpg', 'product-80', 'Description of Product 80', 10664.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(81, 4, 3, 'Product 81', 'img/product/product-details-4.jpg', 'product-81', 'Description of Product 81', 18254.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(82, 1, 2, 'Product 82', 'img/product/product-details-1.jpg', 'product-82', 'Description of Product 82', 19906.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(83, 3, 2, 'Product 83', 'img/product/product-details-3.jpg', 'product-83', 'Description of Product 83', 229577.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(84, 1, 3, 'Product 84', 'img/product/product-details-1.jpg', 'product-84', 'Description of Product 84', 121819.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(85, 4, 1, 'Product 85', 'img/product/product-details-4.jpg', 'product-85', 'Description of Product 85', 81807.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(86, 1, 2, 'Product 86', 'img/product/product-details-1.jpg', 'product-86', 'Description of Product 86', 84008.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(87, 3, 2, 'Product 87', 'img/product/product-details-3.jpg', 'product-87', 'Description of Product 87', 151098.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(88, 2, 3, 'Product 88', 'img/product/product-details-2.jpg', 'product-88', 'Description of Product 88', 96076.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(89, 3, 3, 'Product 89', 'img/product/product-details-3.jpg', 'product-89', 'Description of Product 89', 172202.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(90, 2, 1, 'Product 90', 'img/product/product-details-2.jpg', 'product-90', 'Description of Product 90', 189751.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(91, 4, 1, 'Product 91', 'img/product/product-details-4.jpg', 'product-91', 'Description of Product 91', 120533.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(92, 4, 2, 'Product 92', 'img/product/product-details-4.jpg', 'product-92', 'Description of Product 92', 227325.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(93, 2, 2, 'Product 93', 'img/product/product-details-2.jpg', 'product-93', 'Description of Product 93', 140626.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(94, 3, 3, 'Product 94', 'img/product/product-details-3.jpg', 'product-94', 'Description of Product 94', 180541.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(95, 2, 2, 'Product 95', 'img/product/product-details-2.jpg', 'product-95', 'Description of Product 95', 53488.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(96, 3, 1, 'Product 96', 'img/product/product-details-3.jpg', 'product-96', 'Description of Product 96', 11212.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(97, 3, 2, 'Product 97', 'img/product/product-details-3.jpg', 'product-97', 'Description of Product 97', 182065.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(98, 3, 3, 'Product 98', 'img/product/product-details-3.jpg', 'product-98', 'Description of Product 98', 113213.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(99, 4, 1, 'Product 99', 'img/product/product-details-4.jpg', 'product-99', 'Description of Product 99', 212433.00, NULL, 100, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(100, 3, 1, 'Product 100', 'img/product/product-details-3.jpg', 'product-100', 'Description of Product 100', 155191.00, NULL, 98, NULL, 'PUBLISH', '2023-06-26 22:43:38', '2023-07-06 08:15:05'),
	(101, 3, 1, 'Snack Keripik', 'img/product/snack-keripik.png', 'snack-keripik', '<p><strong>Snack Pringles Keripik Kentang&nbsp;</strong></p>\r\n<p>Pringles keripik kentang terbuat dari bahan berkualitas dengan taburan bumbu di atas keripik yang bertekstur tipis sehingga terasa renyah dan gurih. Cocok di nikmati saat santai dan berbagai momen bersama orang spesial dan keluarga.&nbsp;</p>\r\n<p>Dibuat dari kentang asli dengan kemasan yang praktis sehingga mudah di bawa kemana-mana. Cocok untuk snack sehari hari karena rendah kalori. Masa kadaluarsanya 2024 sehingga masih lama.&nbsp;</p>\r\n<p>Snack Prigles punya isi 10 pack untuk satu boxnya. Yuk, nikmati snack kekinian ini yang nikmat dan gurih. Ada juga varian rasa lain seperti BBQ, keju, dan balado yang bisa kamu pilih sesukamu!</p>', 30000.00, 10.00, 50, NULL, 'PUBLISH', '2023-06-26 22:54:27', '2023-06-26 23:31:49');

-- Dumping data for table rezas_ecommerce.roles: ~4 rows (approximately)
DELETE FROM `roles`;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2023-06-26 22:43:37', '2023-06-26 22:43:37'),
	(2, 'merchant', 'web', '2023-06-26 22:43:37', '2023-06-26 22:43:37'),
	(3, 'tax', 'web', '2023-06-26 22:43:37', '2023-06-26 22:43:37'),
	(4, 'member', 'web', '2023-06-26 22:43:37', '2023-06-26 22:43:37');

-- Dumping data for table rezas_ecommerce.role_has_permissions: ~0 rows (approximately)
DELETE FROM `role_has_permissions`;

-- Dumping data for table rezas_ecommerce.shipping_logs: ~1 rows (approximately)
DELETE FROM `shipping_logs`;
INSERT INTO `shipping_logs` (`id`, `transaction_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 'REQUESTED', '2023-07-13 02:49:36', '2023-07-13 02:49:36'),
	(2, 1, 'ALLOCATED', '2023-07-13 02:50:39', '2023-07-13 02:50:39'),
	(3, 1, 'PICKING_UP', '2023-07-13 02:50:43', '2023-07-13 02:50:43'),
	(4, 1, 'PICKED', '2023-07-13 02:50:46', '2023-07-13 02:50:46'),
	(5, 1, 'DROPPING_OFF', '2023-07-13 02:50:49', '2023-07-13 02:50:49'),
	(6, 1, 'DELIVERED', '2023-07-13 02:50:52', '2023-07-13 02:50:52');

-- Dumping data for table rezas_ecommerce.shopping_carts: ~0 rows (approximately)
DELETE FROM `shopping_carts`;

-- Dumping data for table rezas_ecommerce.shops: ~3 rows (approximately)
DELETE FROM `shops`;
INSERT INTO `shops` (`id`, `user_id`, `shop_name`, `slug`, `address`, `lat`, `long`, `created_at`, `updated_at`, `phone`) VALUES
	(1, 2, 'Nikita Fried Chicken', 'nikita-fried-chicken', 'Jl. Beliang, Palangka, Jekan Raya, Kota Palangka Raya, Kalimantan Tengah 74874, Indonesia', '-2.2022776027974516', '113.89824459007355', '2023-06-26 22:43:38', '2023-07-11 02:48:01', '082252961155'),
	(2, 3, 'Bubur Ayam Ceria', 'bubur-ayam-ceria', 'Jalan kota palangka raya', '-2.2136', '113.9108', '2023-06-26 22:43:38', '2023-06-26 22:43:38', '082252961155'),
	(3, 4, 'Ayam Geprek Goldchick', 'ayam-geprek-goldchick', 'Jalan kota palangka raya', '-2.2136', '113.9108', '2023-06-26 22:43:38', '2023-06-26 22:43:38', '082252961155');

-- Dumping data for table rezas_ecommerce.transactions: ~3 rows (approximately)
DELETE FROM `transactions`;
INSERT INTO `transactions` (`id`, `member_id`, `shop_id`, `transaction_code`, `receipt_number`, `status`, `total_products`, `sub_total`, `voucher_discount`, `shipping_fee`, `total`, `name`, `email`, `phone`, `address`, `shipping_method`, `shipping_type`, `waybill`, `latitude`, `longitude`, `payment_channel`, `payment_status`, `paid_date`, `payment_url`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '22421d03-d36e-4554-9a14-96927b100b5c', 'F23070001', 'DONE', 2, 501438.00, 30000.00, 12500.00, 483938.00, 'Samuel Septa Munthe', 'samuel@gmail.com', '082252961155', 'Jalan Raden Fatah no 5', 'gojek', 'instant', 'WYB-1689216576125', '-2.2174529537329306', '113.91067991192193', 'bri_va', 'SETTLEMENT', '2023-07-06 08:15:07', 'https://app.sandbox.midtrans.com/snap/v3/redirection/22421d03-d36e-4554-9a14-96927b100b5c', '2023-07-06 08:15:05', '2023-07-13 02:50:52'),
	(3, 1, 1, '02a43369-58b6-440f-817b-93dfc990e427', 'F23070002', 'PROCESSING', 1, 100434.00, 0.00, 12500.00, 112934.00, 'Samuel Septa Munthe', 'samuel@gmail.com', '082252961155', 'Jalan Palangka Raya', 'gojek', 'instant', NULL, '-2.2116254704537965', '113.90963721712603', 'bri_va', 'SETTLEMENT', '2023-07-12 06:44:46', 'https://app.sandbox.midtrans.com/snap/v3/redirection/02a43369-58b6-440f-817b-93dfc990e427', '2023-07-12 05:41:38', '2023-07-13 01:58:51'),
	(4, 1, 1, 'd0e8e1a8-92d1-4b9c-aa95-e6180150673d', 'F23070003', 'PROCESSING', 1, 165508.00, 0.00, 12500.00, 178008.00, 'Samuel Septa Munthe', 'samuel@gmail.com', '082252961155', 'Jalan Palangka Raya', 'gojek', 'instant', NULL, '-2.2142566506905155', '113.90092947082178', 'bca_va', 'SETTLEMENT', '2023-07-12 05:47:39', 'https://app.sandbox.midtrans.com/snap/v3/redirection/d0e8e1a8-92d1-4b9c-aa95-e6180150673d', '2023-07-12 05:47:36', '2023-07-12 06:43:48');

-- Dumping data for table rezas_ecommerce.transaction_details: ~4 rows (approximately)
DELETE FROM `transaction_details`;
INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `price`, `qty`, `sub_total`, `product_name`, `created_at`, `updated_at`) VALUES
	(1, 1, 100, 155191.00, 2, 310382.00, 'Product 100', '2023-07-06 08:15:05', '2023-07-06 08:15:05'),
	(2, 1, 30, 95528.00, 2, 191056.00, 'Product 30', '2023-07-06 08:15:05', '2023-07-06 08:15:05'),
	(3, 3, 5, 33478.00, 3, 100434.00, 'Product 5', '2023-07-12 05:41:38', '2023-07-12 05:41:38'),
	(4, 4, 9, 165508.00, 1, 165508.00, 'Product 9', '2023-07-12 05:47:36', '2023-07-12 05:47:36');

-- Dumping data for table rezas_ecommerce.users: ~6 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$zRRcd3nky310E.ae6w8RueXtM0K62GZnKC5scDs/fUmbmKpW6hX.O', NULL, '2023-06-26 22:43:37', '2023-07-12 09:34:11'),
	(2, 'nikitafried', 'nikitafried@gmail.com', NULL, '$2y$10$fbHzTM.HjKYjr64q7XXyTOP75y5VEIWobekYoYuR2up8x8RhTy7l.', NULL, '2023-06-26 22:43:38', '2023-07-11 02:48:01'),
	(3, 'buburayam', 'buburceria@gmail.com', NULL, '$2y$10$QOhIb2xQaimv/xoLZcc27udR9YwB8cluvTbHkgqZW6DCPGR.QPmze', NULL, '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(4, 'goldchick', 'goldchick@gmail.com', NULL, '$2y$10$fPWUCwvBjdMuCDByM35MbeQTmkTUvepBcKQABjLxKUaM97LTNq2zy', NULL, '2023-06-26 22:43:38', '2023-06-26 22:43:38'),
	(5, 'samuelsepta', 'samuel@gmail.com', NULL, '$2y$10$MdHuiFxY/47ufA/W3INZEeoGplY63h2qSagnmOG8LuKrY0U9IsLQW', NULL, '2023-06-27 01:25:19', '2023-06-27 18:36:46');

-- Dumping data for table rezas_ecommerce.vouchers: ~0 rows (approximately)
DELETE FROM `vouchers`;
INSERT INTO `vouchers` (`id`, `shop_id`, `code`, `discount`, `min_purchase`, `valid_from`, `valid_until`, `created_at`, `updated_at`) VALUES
	(1, 1, 'CODE', 30000.00, 75000.00, '2023-06-30 22:12:55', '2023-07-30 22:12:56', '2023-06-30 22:13:03', '2023-06-30 22:13:04'),
	(2, 1, 'TESTADD', 50000.00, 50000.00, '2023-07-10 01:45:23', '2023-08-31 16:00:00', '2023-07-10 01:50:55', '2023-07-10 01:50:55');

-- Dumping data for table rezas_ecommerce.voucher_logs: ~0 rows (approximately)
DELETE FROM `voucher_logs`;
INSERT INTO `voucher_logs` (`id`, `shop_id`, `voucher_id`, `transaction_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '2023-07-06 08:15:05', '2023-07-06 08:15:05');

-- Dumping data for table rezas_ecommerce.wishlists: ~0 rows (approximately)
DELETE FROM `wishlists`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
