-- 1. Query 1: Total Item dan Harga Pesanan
SELECT 
  o.id AS order_id, 
  o.customer_name, 
  o.order_date, 
  SUM(oi.quantity) as total_items, 
  SUM(oi.price) AS total_price 
FROM 
  `orders` AS o 
  INNER JOIN order_items AS oi 
WHERE 
  o.id = oi.order_id 
GROUP BY 
  o.id, 
  o.customer_name, 
  o.order_date;


-- 2. Query 2: Pesanan dengan Harga Total Tertinggi
SELECT 
  o.id AS order_id, 
  o.customer_name, 
  o.order_date, 
  SUM(oi.price) AS total_price 
FROM 
  `orders` AS o 
  INNER JOIN order_items AS oi 
WHERE 
  o.id = oi.order_id 
GROUP BY 
  o.id, 
  o.customer_name, 
  o.order_date 
ORDER BY 
  total_price DESC;


-- 3. Query 3: Produk Terpopuler
SELECT 
  p.id AS product_id, 
  p.name AS product_name, 
  SUM(oi.quantity) AS total_quantity 
FROM 
  `products` AS p 
  INNER JOIN order_items AS oi 
WHERE 
  p.id = oi.product_id 
GROUP BY 
  p.id, 
  p.name 
ORDER BY 
  total_quantity DESC;


-- 4. Query 4: Stok Produk Setelah Pemesanan
SELECT 
  p.id AS product_id, 
  p.name AS product_name, 
  (
    SUM(oi.quantity) + p.stock
  ) AS initial_stock, 
  p.stock AS remaining_stock 
FROM 
  `products` AS p 
  INNER JOIN order_items AS oi 
WHERE 
  p.id = oi.product_id 
GROUP BY 
  p.id, 
  p.name, 
  p.stock;


-- 5. Query 5: Pesanan pada Bulan Tertentu
SELECT 
  o.id AS order_id, 
  o.customer_name, 
  o.order_date, 
  SUM(oi.price) AS total_price 
FROM 
  `orders` AS o 
  INNER JOIN order_items AS oi ON o.id = oi.order_id 
WHERE 
  MONTH(order_date) = "12" 
  AND YEAR(order_date) = "2024" 
GROUP BY 
  o.id, 
  o.customer_name, 
  o.order_date;

