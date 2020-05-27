

CREATE DATABASE onlinestore;

CREATE TABLE `tbl_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(500) NOT NULL,
  `price` varchar(500) NOT NULL,
  `category` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `product_name`, `price`, `category`) VALUES
(1, 'Samsung Galaxy S7 Edge', '$600', 'Mobile Phone'),
(2, 'Google nexus', '$450', 'Mobile Phone'),
(3, 'Apple IPhone 6', '$630', 'Mobile Phone'),
(4, 'Sony Vio', '$1200', 'Laptop'),
(5, 'Samsung T.V', '$900', 'T.V'),
(6, 'Apple IPAD', '$710', 'Tablet'),
(7, 'MacBook Pro', '$1000', 'Laptop'),
(8, 'Dell Laptop', '$950', 'Laptop'),
(9, 'Canon EOS 700D DSLR Camera', '$550', 'Camera'),
(10, 'Nikon D7100 DSLR Camera ', '$670', 'Camera');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
