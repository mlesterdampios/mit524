-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 09:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(20) DEFAULT NULL,
  `admin_emailaddress` varchar(30) DEFAULT NULL,
  `admin_password` varchar(32) DEFAULT NULL,
  `admin_firstname` varchar(20) DEFAULT NULL,
  `admin_lastname` varchar(20) DEFAULT NULL,
  `admin_isdeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `admin_username`, `admin_emailaddress`, `admin_password`, `admin_firstname`, `admin_lastname`, `admin_isdeleted`) VALUES
(1, 'admin', NULL, '202cb962ac59075b964b07152d234b70', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(200) DEFAULT NULL,
  `brand_isdeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brands`
--

INSERT INTO `tbl_brands` (`id`, `brand_name`, `brand_isdeleted`) VALUES
(1, 'Dell', 0),
(2, 'HP', 0),
(3, 'LG', 0),
(4, 'Samsung', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_carts`
--

CREATE TABLE `tbl_carts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `cart_product_quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) DEFAULT NULL,
  `category_isdeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category_name`, `category_isdeleted`) VALUES
(1, 'Camera', 0),
(2, 'Desktop', 0),
(3, 'Laptop', 0),
(4, 'Mobile', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` int(11) NOT NULL,
  `customer_username` varchar(20) NOT NULL,
  `customer_billing_emailaddress` varchar(30) DEFAULT NULL,
  `customer_password` varchar(32) NOT NULL,
  `customer_billing_firstname` varchar(20) DEFAULT NULL,
  `customer_billing_lastname` varchar(20) DEFAULT NULL,
  `customer_billing_companyname` varchar(50) DEFAULT NULL,
  `customer_billing_phonenumber` varchar(20) DEFAULT NULL,
  `customer_billing_country` varchar(20) DEFAULT NULL,
  `customer_billing_address1` varchar(200) DEFAULT NULL,
  `customer_billing_address2` varchar(200) DEFAULT NULL,
  `customer_billing_towncity` varchar(200) DEFAULT NULL,
  `customer_billing_zip` varchar(50) DEFAULT NULL,
  `customer_shipping_firstname` varchar(20) DEFAULT NULL,
  `customer_shipping_lastname` varchar(20) DEFAULT NULL,
  `customer_shipping_companyname` varchar(50) DEFAULT NULL,
  `customer_shipping_phonenumber` varchar(20) DEFAULT NULL,
  `customer_shipping_country` varchar(20) DEFAULT NULL,
  `customer_shipping_address1` varchar(200) DEFAULT NULL,
  `customer_shipping_address2` varchar(200) DEFAULT NULL,
  `customer_shipping_towncity` varchar(200) DEFAULT NULL,
  `customer_shipping_zip` varchar(50) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `customer_isdeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `customer_username`, `customer_billing_emailaddress`, `customer_password`, `customer_billing_firstname`, `customer_billing_lastname`, `customer_billing_companyname`, `customer_billing_phonenumber`, `customer_billing_country`, `customer_billing_address1`, `customer_billing_address2`, `customer_billing_towncity`, `customer_billing_zip`, `customer_shipping_firstname`, `customer_shipping_lastname`, `customer_shipping_companyname`, `customer_shipping_phonenumber`, `customer_shipping_country`, `customer_shipping_address1`, `customer_shipping_address2`, `customer_shipping_towncity`, `customer_shipping_zip`, `date_created`, `customer_isdeleted`) VALUES
(1, 'mlesterdampios', NULL, 'd93591bdf7860e1e4ee2fca799911215', 'Mark Lester', 'Dampios', 'RxM Solutions', '09354635971', 'Philippines', 'Blk-6 Lot-3 Isla Homeowners, Isla', '', 'Valenzuela City', '1444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-04-18 03:01:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_product_quantity` int(11) DEFAULT '1',
  `order_product_price` double(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `payment_id`, `product_id`, `order_product_quantity`, `order_product_price`) VALUES
(1, 1, 16, 1, 4405.00),
(2, 1, 11, 1, 38995.00),
(3, 1, 7, 1, 14888.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_mode_name` varchar(50) DEFAULT NULL,
  `payment_mode_code` varchar(50) DEFAULT NULL,
  `payment_receipt_code` varchar(50) DEFAULT NULL,
  `payment_receipt_link` varchar(50) DEFAULT NULL,
  `payment_total_price` double(10,2) NOT NULL DEFAULT '0.00',
  `payment_status` varchar(50) DEFAULT 'Pending',
  `payment_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `payment_billing_emailaddress` varchar(30) DEFAULT NULL,
  `payment_billing_firstname` varchar(20) DEFAULT NULL,
  `payment_billing_lastname` varchar(20) DEFAULT NULL,
  `payment_billing_companyname` varchar(50) DEFAULT NULL,
  `payment_billing_phonenumber` varchar(20) DEFAULT NULL,
  `payment_billing_country` varchar(20) DEFAULT NULL,
  `payment_billing_address1` varchar(200) DEFAULT NULL,
  `payment_billing_address2` varchar(200) DEFAULT NULL,
  `payment_billing_towncity` varchar(200) DEFAULT NULL,
  `payment_billing_zip` varchar(50) DEFAULT NULL,
  `payment_shipping_firstname` varchar(20) DEFAULT NULL,
  `payment_shipping_lastname` varchar(20) DEFAULT NULL,
  `payment_shipping_companyname` varchar(50) DEFAULT NULL,
  `payment_shipping_phonenumber` varchar(20) DEFAULT NULL,
  `payment_shipping_country` varchar(20) DEFAULT NULL,
  `payment_shipping_address1` varchar(200) DEFAULT NULL,
  `payment_shipping_address2` varchar(200) DEFAULT NULL,
  `payment_shipping_towncity` varchar(200) DEFAULT NULL,
  `payment_shipping_zip` varchar(50) DEFAULT NULL,
  `payment_isdeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `user_id`, `payment_mode_name`, `payment_mode_code`, `payment_receipt_code`, `payment_receipt_link`, `payment_total_price`, `payment_status`, `payment_date`, `payment_billing_emailaddress`, `payment_billing_firstname`, `payment_billing_lastname`, `payment_billing_companyname`, `payment_billing_phonenumber`, `payment_billing_country`, `payment_billing_address1`, `payment_billing_address2`, `payment_billing_towncity`, `payment_billing_zip`, `payment_shipping_firstname`, `payment_shipping_lastname`, `payment_shipping_companyname`, `payment_shipping_phonenumber`, `payment_shipping_country`, `payment_shipping_address1`, `payment_shipping_address2`, `payment_shipping_towncity`, `payment_shipping_zip`, `payment_isdeleted`) VALUES
(1, 1, 'Cash On Delivery', NULL, NULL, NULL, 58288.00, 'Pending', '2019-04-18 03:01:29', NULL, 'Mark Lester', 'Dampios', 'RxM Solutions', '09354635971', 'Philippines', 'Blk-6 Lot-3 Isla Homeowners, Isla', '', 'Valenzuela City', '1444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_isavailable` tinyint(1) DEFAULT '1',
  `product_name` varchar(50) DEFAULT NULL,
  `product_price` double(10,2) DEFAULT NULL,
  `product_shortdescription` varchar(200) DEFAULT NULL,
  `product_wysiwyg_description` varchar(5000) DEFAULT NULL,
  `product_image` varchar(50) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `product_isdeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `category_id`, `brand_id`, `product_isavailable`, `product_name`, `product_price`, `product_shortdescription`, `product_wysiwyg_description`, `product_image`, `date_created`, `product_isdeleted`) VALUES
(1, 1, 1, 1, 'Zeus W8R 4K Wifi Ultra HD Action Pro Sports Camera', 978.00, 'Provides you just the right amount of surface screen to check your photos\r\nAllows you to take hi-res photos\r\nHigh quality', '<h2 class=\"pdp-mod-section-title \" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: Roboto-Medium; font-size: 16px; line-height: 19px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;\">Specifications of Zeus W8R 4K Wifi Ultra HD Action Pro Sports Camera With Remote (White)</h2><h2 class=\"pdp-mod-section-title \" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: Roboto-Medium; font-size: 16px; line-height: 19px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;\"><div class=\"pdp-general-features\" style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 14px; white-space: normal;\"><ul class=\"specification-keys\" style=\"margin: 16px -15px 0px; padding: 0px; list-style: none; height: auto; font-size: 14px;\"><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Brand</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">Zeus</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">SKU</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">ZE108ELAAAVXMNANPH-21752938</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Warranty Type</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">Local Manufacturer Warranty</div></li><li class=\"key-li\" style=\"margin: 0px 0px 8px; padding: 0px 15px; display: inline-block; width: 490px; vertical-align: top; line-height: 18px;\"><span class=\"key-title\" style=\"margin: 0px 18px 0px 0px; padding: 0px; display: inline-block; width: 140px; vertical-align: top; color: rgb(117, 117, 117); word-break: break-word;\">Warranty Period</span><div class=\"html-content key-value\" style=\"margin: 0px; padding: 0px; word-break: break-word; display: inline-block; width: 306px;\">1 Year</div></li></ul></div><div class=\"box-content\" style=\"margin: 28px 0px 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 14px; white-space: normal;\"><span class=\"key-title\" style=\"margin: 0px; padding: 0px; display: table-cell; width: 140px; color: rgb(117, 117, 117); word-break: break-word;\">Whatâ€™s in the box</span><div class=\"html-content box-content-html\" style=\"margin: 0px; padding: 0px 0px 0px 18px; word-break: break-word; display: table-cell;\"><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none;\"><li style=\"margin: 0px; padding: 0px; display: inline-block;\">1 x Zeus W8R Action Camera</li><li data-spm-anchor-id=\"a2o4l.pdp.product_detail.i3.70906d34w6UYKm\" style=\"margin: 0px; padding: 0px; display: inline-block;\">1 x Camera Accessories</li></ul></div></div></h2>', 'camera_dell.png', '2019-04-18 02:16:31', 0),
(2, 1, 2, 1, 'SJCAM SJ7 Star LCD Touch Screen 4K HD Action Camer', 4999.00, '1 x SJ7 Action Camera ( Built-in 1000mAh Lithium Battery ), 1 x Waterproof Housing + Mount + Screw, 1 x Frame, 2 x Base, 2 x Adhesive, 2 x Mount, 3 x Connector + Screw, 1 x Handle Bar Mount, 1 x Tripo', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i0.353c17679FiC5P\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of SJCAM SJ7 Star LCD Touch Screen 4K HD Action Camera</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc height-limit\" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: 780px; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Type of Camera: 4K</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Chipset Name: Ambarella</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Chipset: Ambarella A12S75</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Sensor: CMOS</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Function: Motion Detection</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Application: Extreme Sports,Underwater</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Features: Wireless</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Screen size: 2.0inch</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Screen type: LTPS</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Screen resolution: 320x240</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Wide Angle: 166 degree wide angle lens</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Video format: MP4</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Video Resolution: 1080P (120fps),1080P (1920 x 1080),1080P(30fps),1080P(60fps),1280 x 960,1440P (2560 x 1440),1440P (30fps),1440P (60fps),1920 x 1440,2.5K (30fps),2.5K (60fps),2.7K (2704 x 1520),2.7K (2704x2028),2.7K (30fps),2160P (2880 x 2160),4K (25fps),4K (30fps),4K (3840 x 2160),720P (120fps),720P (1280 x 720),720P (240fps),720P (30fps),720P (60fps),960P (120fps),960P (30fps),960P (60fps)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Video Frame Rate: 120fps,240fps,25fps,30FPS,60FPS,90fps</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Image Format : JPEG</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Image resolutions: 2048 x 1536 (3MP),2560 x 1920 (5MP),3840Ã—2160 (8.3MP),4000 x 3000 (12MP),4254Ã—3264 (14MP),4608 x 34', 'camera_hp.png', '2019-04-18 02:33:19', 0),
(3, 1, 3, 1, 'A7 Video Action Camcorder HD 1080P 2.0 LCD Screen ', 388.00, '1 x action cam 1 x waterproof housing 1 x Charging Cable 5 x Mounting parts 1 x Instruction manual', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i4.27041123LCqrLU\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of A7 Video Action Camcorder HD 1080P 2.0 LCD Screen Sports Action Camera with Waterproof Case</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" data-spm-anchor-id=\"a2o4l.pdp.product_detail.i3.27041123LCqrLU\" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" data-spm-anchor-id=\"a2o4l.pdp.product_detail.i1.27041123LCqrLU\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" data-spm-anchor-id=\"a2o4l.pdp.product_detail.i2.27041123LCqrLU\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" data-spm-anchor-id=\"a2o4l.pdp.product_detail.i4.27041123LCqrLU\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">140 degree wide angle lense captures action in several formats</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1080p + Waterproof</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">video:1920*1080 pixel 15fps, 1280*720 pixels 30fps</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">waterproof: Up to 30m</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1.5/2.0-inch LCD</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Multi-language</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">storage:Micro SDHC card (not included)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Battery:900mAh (1.5 hours)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Input/Output :Micro USB</li></ul></div></div></div>', 'camera_lg.png', '2019-04-18 02:34:37', 0),
(4, 1, 4, 1, 'Action Sports Camera 1080P HD Under Water Cam(Gold', 308.00, '1 x A7 Ultimate Sports Action Cam Under Water Extreme 1 x Waterproof Housing 1 x Handle Bar / Pole Mount 1 x Mount 1 x Clip 1 1 x USB Cable 1 x Mount 7 1 x Helmet Mount 4 x Bandages 1 x Battery 1 x Us', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i3.2ed9716ctm4684\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Action Sports Camera 1080P HD Under Water Cam(Gold)A7</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">FULL HD 1080P Video Resolution+ 30M Waterproof</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Video ï¼š1920*1080 pixel 15fps 1280*720 pixel 30 fps</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Super Wide Angle Lens: 140 degree</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">2 inches LCD screen display, 320 x 240 pixel resolution</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Waterproof: Up to 30m</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Storage : TF/SD card up to 32 GB( Not INCLUDED)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">ROM: 32MP SPI</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">USB: USB2.0 type</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Battery: 900mAh</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Multi-Language</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Input/Output: Micro USB</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Dimensionsï¼šï¼ˆL*W*Hï¼‰59.3*24.6*41.1 mm</li></ul></div></div></div>', 'camera_samsung.png', '2019-04-18 02:38:29', 0),
(5, 2, 1, 1, 'PCX DESKTOP BATTLE MOD (I5RTX2060) INTEL CORE I5-8', 64124.00, '1 x PCX DESKTOP BATTLE MOD (I5RTX2060) \r\n1 x Power Cord ', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i3.30614e0fXBGBu2\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of PCX DESKTOP BATTLE MOD (I5RTX2060) INTEL CORE I5-8400 8GB 250GB SSD+1TB HDD RTX2060 WIN10 PRO (BLACK)</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Processor: INTEL CORE I5-8400 (2.80GHZ)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Motherboard: ASUS TUF B360M-PLUS GAMING</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Memory: KINGSTON 8GB 2400MHZ FURY BLK (HX424C15FB2/8)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Storage: KINGSTON 240GB UV500 SSD +SEAGATE 1TB SATA (ST1000DM010)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Graphics Card: GIGABYTE RTX2060 WINDFORCE OC 6GB GDDR6 192BIT</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Power Supply: THERMALTAKE TR2 S 700W 80+</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Casing: AEROCOOL STRIKE X ONE ADV. USB3.0</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Operating System: WINDOWS 10 PRO 64BIT OEM</li></ul></div></div></div>', 'desktop_dell.png', '2019-04-18 02:39:58', 0),
(6, 2, 2, 1, 'HP 24-F0031D 23.8\" IntelÂ® Coreâ„¢ i3-8130U 4GB DD', 35990.00, '1 x HP 24-F0031D 23.8\" Desktop, 1 x Users Manual, 1 x Keyboard, 1 x Mouse, 1 x Monitor, 1 x Power Cable', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i2.45a6698egTrzvT\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of HP 24-F0031D 23.8\" IntelÂ® Coreâ„¢ i3-8130U 4GB DDR4 1TB Windows 10</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Processor: IntelÂ® Coreâ„¢ i3-8130U (2.2 GHz up to 3.4 GHz)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Memory: 4GB DDR4</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Hard Drive: 1TB</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Optical Drive: Yes</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Graphics Card: Shared</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Display: 23.8\" IPS NON-TOUCH</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Operating System: Windows 10</li></ul></div></div></div>', 'desktop_hp.png', '2019-04-18 02:40:59', 0),
(7, 2, 3, 1, 'Razor Gaming Desktop', 14888.00, '1 x 18.5 Monitor1 x Keyboard1 x Mouse1 x AVR1 x CPU', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i2.57b66c1flvTfsV\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Razor Gaming Desktop</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Processor: AMD A4-7300 4.0ghz Dual Core</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Motherboard: Emaxx A70FM2+ICAFE FM2 AVL MATX</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Memory:4GB capacity; Hard disk: 1 TB HDD</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Casing: ATX casing with 600watts Powersupply</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Keyboard /Mouse Rapoo : USB wired combo</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Monitor: AOC 18.5\"</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Speaker: USB Speaker</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">No Optical Drive; AVR: 500watts</li></ul></div></div></div>', 'desktop_lg.png', '2019-04-18 02:41:52', 0),
(8, 2, 4, 1, 'Computer Set Lenovo ThinkCentre 7522 SFF / Monitor', 4995.00, '1x Lenovo 7522 Unit, 1x Monitor 17\", 1x Keyboard, 1x Mouise, 1x Vga Cable 2x Power Cord', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i1.74ef20acc0YHkF\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Computer Set Lenovo ThinkCentre 7522 SFF / Monitor 17 Inch Square Assorted Core2Duo 2.9-3.0ghz 4GB DDR2 160GB HDD Slim Type Desktop Complete Computer Package with Keyboard Mouse</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">E7500-E8500 Core2duo Processor</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">4GB DDR2</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">160GB HDD Sata type</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Already Used Item Unit and Monitor Only/ Surplus Items</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Original Parts such as Casing / PSU, Board,RAM Etc</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Heavy Duty Unit can be use 24/7</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Low Setting on Online Games like DOta2, LOL, ROS Etc</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Upgradable Videocard for Best Result fo Graphics</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Assorted Monitor will be Served</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Brand New Keyboard mouse</li></ul></div></div></div>', 'desktop_samsung.png', '2019-04-18 02:44:05', 0),
(9, 3, 1, 1, 'Acer Notebook A315-41-R287 / Ryzen 3-2200U / 4GB /', 24349.00, 'Highlighting Form and Function\r\nA stunningly slim body and impressive tactile finish accentuate real-world design features.\r\n\r\nundamentally Impressive Tech\r\nBuilt to keep you active, engaged, and on t', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i2.370916b57TtzYv\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Acer Notebook A315-41-R287 / Ryzen 3-2200U / 4GB / 1TB / 15.6\" / WIN10 / 2-2-0</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc height-limit\" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: 780px; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Model : A315-41-R287</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Color : Obsidian Black</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Processor : Ryzen 3-2200U</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Memory : 4GB</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Storage : 1TB</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Display Size : 15.6</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Operating Syetem : Windows 10</li></ul></div></div></div>', 'laptop_dell.png', '2019-04-18 02:47:36', 0),
(10, 3, 2, 1, 'Asus Laptop VivoBook X507UA Intel Core i3-8130u Di', 28480.00, 'Asus X507UA', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i3.31781afeCGIOto\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Asus Laptop VivoBook X507UA Intel Core i3-8130u Display: 15.6In HD, Memory: 4GB DDR4, HD: 1TB HDD, OS: Win10 w/ FREE Asus BackPack</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" data-spm-anchor-id=\"a2o4l.pdp.product_detail.i1.31781afeCGIOto\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">ProcessorIntel Core i3-8130u 2.20GHzOperating SystemWindows 10ChipsetIntegrated Intel CPUMemory4GB DDR4 2400MHz SDRAM, 1 x SO-DIMM socket , up to 8 GB SDRAMGraphicsIntegrated Intel HD GraphicsDisplay15.6\" (16:9) LED backlit HD (1366x768) 60Hz Anti-Glare Panel with 45% NTS</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Support ASUS Splendid TechnologyStorage1TB 5400RPM SATA HDDKeyboardChiclet keyboardCard ReaderMulti-format card readerWebCamVGA Web CameraWi-FiIntegrated 802.11b/g/nBluetoothBuilt-in Bluetooth V4.1Interface1 x COMBO audio jack ,</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1 x Type A USB3.0 (USB3.1 GEN1) ,</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">2 x USB 2.0 port(s),</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1 x HDMIAudioBuilt-in Stereo 2 W Speakers And Microphone,</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">ASUS SonicMaster TechnologyBattery3 Cells 33 Whrs BatteryDimensions365 x 266 x 21.9 mm (WxDxH)Weight1.68 kg</li></ul></div></div></div>', 'laptop_hp.png', '2019-04-18 02:48:53', 0),
(11, 3, 3, 1, 'LENOVO 320-15IKB (81BG005BPH) 15.6â€ INTEL CORE I', 38995.00, '1 x LENOVO 320-15IKB (81BG005BPH) I5 NVIDIA BLACK \r\n1 x Charger\r\n1 x Battery (may already be installed)\r\nDocumentation (If any)', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i2.139b556bBmjmEE\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of LENOVO 320-15IKB (81BG005BPH) 15.6â€ INTEL CORE I5 8250U 4GB 2TB NVIDIA MX150 WIN10 (BLACK)</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">2 x USB 3.1 gen1</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1 x USB 3.1 Type-C gen1</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">HDMI</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Ethernet (RJ45)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">4-in-1 Card Reader (MMC, SD, SDHC, SDXC)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">combo audio/mic jack</li></ul></div></div></div>', 'laptop_lg.png', '2019-04-18 02:49:39', 0),
(12, 3, 4, 1, 'Toshiba Satellite L505 Laptop w/Cam', 5799.00, 'Unit + charger + mouse', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i1.668a328eu7Vd5S\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Toshiba Satellite L505 Laptop w/Cam</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Toshiba Satellite L505 Laptop</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">15.6â€ Display</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Pentium Processor</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">2GB RAM</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">80GB HDD</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ Camera</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ DVD</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ WIFI</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ Word</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ Excel</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ PowerPoint</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">âœ”ï¸ Chrome</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">#yamigo #laptop #toshiba</li></ul></div></div></div>', 'laptop_samsung.png', '2019-04-18 02:50:48', 0),
(13, 4, 1, 1, 'OPPO A71 2018 2GB/16GB Dual SIM 3000mah Battery 5M', 5490.00, 'OPPO A71 2018, Earphones, Micro USB cable, Charger, SIM ejector tool, Documentation, Selfie Stick, Tripod, Globe SIM', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i2.42d17892cMW6U4\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of OPPO A71 2018 2GB/16GB Dual SIM 3000mah Battery 5MP Front Camera</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Front Camera: 5MP (with AI Beauty Recognition Technology)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Rear Camera: 13MP (with Multi-Frame Denoising Technology for noise reduction and with Ultra HD Technology)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Flash: LED Flash</li><li class=\"\" data-spm-anchor-id=\"a2o4l.pdp.product_detail.i2.42d17892cMW6U4\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Aperture: f/2.2 (rear), f/2.4 (front)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Display Size: 5.2â€ (for immersive gaming and crystal clear images)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Display Type: TFT</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Resolution: HD (1280 by 720 pixels)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Display Colors: 16 million colors</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Touchscreen: Multi-touch, Capacitive Screen, Gorilla Glass 5</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Storage: 16GB (expandable up to 256GB)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">RAM: 2GB</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Operating System: ColorOS 3.2, based on Android 7.1 (makes your mobile journey faster, safer and easier than ever)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Processor: Qualcomm SDM 450 (allows switch between apps with ease and a fantastic gaming experience, 12.5% speed improvement on app starting speed)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">GPU: Adreno 506</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Battery: 3000mAh (Typ)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Slot Trays: Triple, 2 for SIM ', 'mobile_dell.png', '2019-04-18 02:52:17', 0);
INSERT INTO `tbl_products` (`id`, `category_id`, `brand_id`, `product_isavailable`, `product_name`, `product_price`, `product_shortdescription`, `product_wysiwyg_description`, `product_image`, `date_created`, `product_isdeleted`) VALUES
(14, 4, 2, 1, 'Infinix X573 Hot S3 3GB RAM 32GB ROM (Blush Gold)', 5980.00, 'â€¢	1 x Infinix X573 Hot S3 3GB RAM 32GB ROM (Brush Gold) â€¢	1 x User Manual â€¢	1 x Screen Protector â€¢	1 x Jelly Case (Black) â€¢ 1 x Earphone â€¢	1 x USB Cable â€¢	1 x Power Adapter â€¢	1 x Eject', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i3.5ac458fdfSahVr\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Infinix X573 Hot S3 3GB RAM 32GB ROM (Blush Gold)</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">32GB Internal Storage / 3GB RAM Memory</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">13MP rear camera w/ Dual LED flash</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">20MP front camera w/ Dual LED flash</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Dual SIM (Nano-SIM, dual stand-by)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">External Storage Micro SD Up to 128 GB</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">5.7-inch IPS HD+ 720 x 1440 IPS 18:9 Display</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">XOS 3 (Android 8.0 Oreo)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Qualcomm Snapdragon 430 (MSM8937)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Octa-Core ARM Cortex-A53 @ 1401MHz</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Fingerprint (back), Compass/ Magnetometer, Proximity, Accelerometer, Gyroscope, Ambient Light Sensor Supported</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">4G, 3G, 2G and LTE Supported</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Micro USB v2.0 (OTG Support)</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Material: Plastic Body</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Non-removable Li-polymer 4000 mAh battery</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">3.5mm Earphone/Headphone Port</li></ul></div></div></div>', 'mobile_hp.png', '2019-04-18 02:53:56', 0),
(15, 4, 4, 1, 'Samsung B105 Dual SIM Mobile Phone Keystone2 Camer', 619.00, '1X SAMSUNG Mobile Phone', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i2.1d537684W9FAxK\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Samsung B105 Dual SIM Mobile Phone Keystone2 Camera Cellphone BUY 1 TAKE 1</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc \" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: auto; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Dual Sim Card</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Camera</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Big Battery Inside</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">FM</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">torch light</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">1.77 Color Display</li></ul></div></div></div>', 'mobile_samsung.png', '2019-04-18 02:54:51', 0),
(16, 4, 3, 1, 'ORIGINAL lPHONE 5S 16GB / 32GB', 4405.00, 'iPhone itself, Box with manuals, USB Cable and Charger, Headset', '<h2 class=\"pdp-mod-section-title outer-title\" data-spm-anchor-id=\"a2o4l.pdp.0.i0.314966b7RyJ6Y1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px 24px; font-family: Roboto-Medium; font-size: 16px; line-height: 52px; color: rgb(33, 33, 33); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 52px; background: rgb(250, 250, 250);\">Product details of Xiaomi Redmi 6A 2GB RAM 16GB ROM Helio A22 2.0GHz (Global Version)</h2><div class=\"pdp-product-detail\" data-spm=\"product_detail\" style=\"margin: 0px; padding: 0px; position: relative; font-family: Roboto, -apple-system, BlinkMacSystemFont, \"Helvetica Neue\", Helvetica, sans-serif; font-size: 12px;\"><div class=\"pdp-product-desc height-limit\" style=\"margin: 0px; padding: 5px 14px 5px 24px; height: 780px; overflow-y: hidden;\"><div class=\"html-content pdp-product-highlights\" style=\"margin: 0px; padding: 11px 0px 16px; word-break: break-word; border-bottom: 1px solid rgb(239, 240, 245); overflow: hidden;\"><ul class=\"\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; list-style: none; overflow: hidden; columns: auto 2; column-gap: 32px;\"><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Display: 5.45 inch 1440 x 720 pixels</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">CPU: MTK6762M Quad Core 2.0GHz</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">System: MIUI 9.0 ( Android 8.1 )</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Storage: 2GB RAM + 16GB ROM</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Cameras: 13.0MP rear camera and 5.0MP front camera</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Sensors: Ambient light sensor, Gyroscope, Distance sensor, E-compass, G-sensor</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Features: GPS, Glonass, AGPS</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">Bluetooth:4.1</li><li class=\"\" style=\"margin: 0px; padding: 0px 0px 0px 15px; position: relative; line-height: 18px; text-align: left; list-style: none; word-break: break-word; break-inside: avoid;\">SIM Card: Nano Sim card + Nano Sim card / micro SD card</li></ul></div></div></div>', 'mobile_lg.png', '2019-04-18 02:55:55', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customer_username` (`customer_username`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_carts`
--
ALTER TABLE `tbl_carts`
  ADD CONSTRAINT `tbl_carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`id`),
  ADD CONSTRAINT `tbl_carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`);

--
-- Constraints for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `tbl_payments` (`id`),
  ADD CONSTRAINT `tbl_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`);

--
-- Constraints for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD CONSTRAINT `tbl_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_customers` (`id`);

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_categories` (`id`),
  ADD CONSTRAINT `tbl_products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
