-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 04:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artibidz`
--

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE `art` (
  `art_id` int(11) NOT NULL,
  `art_name` varchar(60) NOT NULL,
  `art_desc` varchar(2000) NOT NULL,
  `art_date` date NOT NULL,
  `art_amt` int(11) NOT NULL,
  `art_qty` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sale_or_auction` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`art_id`, `art_name`, `art_desc`, `art_date`, `art_amt`, `art_qty`, `sub_cat_id`, `user_id`, `sale_or_auction`) VALUES
(2, 'Allah In Arabic Calligraphy', 'About this item LUXURIOUS & ELEGANT: Enhance the beauty of your walls with this breathtaking artwork | High resolution printing on our textured canvas makes the art prints matching the originals MATERIAL: Premium sustainable quality & artistic painting canvas | Engineered Wood Mounting | SIZE: 16 x 22.7 inch (41 x 58 cms) WITH FRAMING: Canvas art print mounted on 6mm (0.24 inch) thick & sturdy engineered wood (MDF board) | Ready to hang on wall EASY TO INSTALL: Ready to install | No assembly required | Pre-fitted with wall hanging hooks | Easy hanging and removal from the wall QUALITY ASSURED: Protect from direct sunlight, extreme temperature, dust and moisture to ensure long life', '2020-05-12', 999, 1, 2, 6, 'sale'),
(4, 'round wall art', 'About this item Exquisite Artistic Design: This round-shaped resin decorative piece features a captivating depiction of a moonlit wave beach scene, adding a touch of serenity and artistic elegance to your home decor. Versatile Use: This piece is suitable for a variety of applications, serving as a perfect decorative element for your bedroom or living room, and also functioning as an eye-catching tableware for your dining or coffee table. Durable Resin Construction: Crafted from durable and high-quality resin, this decorative round shape art piece is built to withstand daily use, ensuring long-lasting beauty and functionality for both wall display and tabletop usage. Tranquil Home Ambiance: The moonlit wave beach scene creates a serene and calming ambiance, making it an ideal addition to any contemporary or coastal-themed interior design, adding a touch of tranquility and sophistication to your living space. Artistic Centerpiece: The intricate and detailed beach art design is sure to capture the attention of g', '2023-07-07', 1799, 2, 12, 2, 'sale'),
(5, 'Great Art Lord ganesh painting', 'About this item 🎨ARTWORK: This ganesha artwork is designed by our professional graphics designer, considering colors and other combination so that this art looks great on any kind of wall and bring good vibes to your ambience ✅💯HIGH QUALITY DIGITAL PRINT: This artwork is then printed on a best quality glossy paper especially made for digital printing. 🎴STYLISH SYNTHETIC WOODEN FRAME AND PROTECTOR FILM: After printing, we mount the prints on a robust MDF board with a high quality protector film, which protects your painting with dust and moisture. Then, the synthetic wooden frame is added for final assembly making your painting perfect for elegant look in size of (L x W x H - 13.5 x 13.5 x 0.5) Inches. 📦PACKAGE CONTAINS: 1 Lord Ganesha Framed Painting | PACKING AND DELIVERY: After assembling the artwork, we pack the framed painting carefully with bubble wrapped sheet and high quality cover so that painting remain intact during the course of delivery. 🎁READY TO HANG/GIFT: You can hang this beautiful painting at your home for a modern look on wall, living room, dining room wall, kitchen, worship place, work desk, kids study area. Apart from home decor, this painting will provide peaceful vibes to your office, cafe, lounge, restaurant. This is perfect for gifting as well. Be it any occasion from birthdays to anniversaries, house warming to new office, festivals to retirements. This is just perfect gift for any event you think of.', '2012-06-21', 849, 1, 11, 5, 'sale'),
(6, 'Resin  Black white gold clock', 'Resin clock is an elegant, unique and beautiful decor that blends harmoniously with any interior design of the living room, bedroom, kitchen and other rooms. Also, handmade epoxy resin clocks will be a wonderful gift for your friends and loved ones for anniversaries, birthdays, weddings and housewarmings. We can also make this clock model in the colors and sizes you need, and pick up various options for accessories for clocks (clock hands, numbers in other styles and colors).', '2023-11-21', 1500, 1, 13, 8, 'sale'),
(7, 'RAM CHARAN painting ', 'About this item\r\nMATERIAL: stretched canvas\r\nSTYLE: classic religious\r\nART: mandala art\r\nSTATUS: ready to hang\r\nFOR: Home office puja room etc...', '2023-09-20', 1200, 2, 14, 1, 'sale'),
(8, 'Naruto & Kurama', ' Embark on a visual journey into the heart of the Hidden Leaf Village with our captivating canvas sketch, \"Eternal Bonds: Naruto and Kurama.\" This unique piece pays homage to the iconic duo, Naruto Uzumaki and Kurama, capturing the essence of their indomitable spirit and unwavering friendship. \r\nlength: 20*20\r\n', '2022-02-15', 1999, 1, 8, 4, 'sale'),
(13, 'Mini Gayatri Mantra Frame', 'Colour	Multi Product Dimensions	30.5L x 30.5W Centimeters Shape	Frame 2 Frame Type	Single Picture Frame About this item Mini Gayatri Mantra Frame Sacred Spiritual Art Elegant Design Daily Inspiration Ideal Meditation Companion Thoughtful Gift Option', '2022-06-07', 2000, 1, 2, 1, 'sale'),
(14, 'Buddha', 'Age Range (Description)	Kids and Adults Colour	Scenery1 Theme	Number Cartoon Character	sports About this item Premium Canvas: Professional oil canvas comes with a good density and is easy to colour. The finished size is 40*50cm which is a comfortable size even for beginners. The brushes have good water absorption and hence are easy to clean. Components: In the Skudgear DIY painting kit you will get a pre-printed textured canvas (unframed), 1 set of acrylic paints, and 1 set of brushes including 1 big, 1 medium, and 1 small brush. Memorable Wall Decor: What else can even make it near to your hand-painted painting on your wall? Our DIY painting will be the most amazing decor and also a cute family memory. Begin your Painting Adventures: This is a great gift option to consider if you are planning to gift it to someone who is really interested in painting and wants to learn it. Our DIY painting kit is a great way to kick-start one\'s interest in painting. Beginner friendly: This set will definitely keep you engaged for hours. Our painting kit is the Great Pick to spend your family time in a creative way. Our paint-by-numbers offer fresh contemporary designs and require no blending of colors, so painting a beautiful work of art is easy! This kit includes everything you need to get started. Oh! It\'s beginners friendly.', '2023-05-23', 1799, 1, 5, 1, 'sale'),
(15, 'PAPER PLANE DESIGN', 'Size	18 Inch x 24 Inch Product Dimensions	60L x 45W Centimeters Item Weight	3 Kilograms Number of Items	1 Orientation	Landscape Shape	Rectangular Theme	Abstract Wall art form	Painting Colour	D Style	Modern See less About this item SIZE: Check Variations for different sizes. MATERIAL: Cotton canvas streched on wooden bars for long life. SPECIALITY: Vibrant colours, long life of frame and artwork, big size. SUITABLE FOR: Living room walls, bedroom decor, office wall decoration. THEME: Abstract Canvas Paintings.', '2021-11-22', 1430, 1, 11, 1, 'sale'),
(16, 'Lion Wild Anima', 'Size	8 x 12 inches Product Dimensions	30.5L x 20.3W Centimeters Item Weight	400 Grams Number of Items	1 Orientation	Portrait Shape	Rectangular Theme	Animal Recommended Uses For Product	Home Decor and Wall Decor Frame Type	Framed Wall art form	Painting  About this item PREMIUM QUALITY - High Quality 8x12 Inch Paper HD wall painting - Without Plexi Glass LONG LASTING - Superior Quality Synthetic Wood Frame SUITABLE FOR ALL ROOMS - Living room, bedroom, kitchen, hall, dining, office, kids, pooja and temple EASY TO HANG - Easy installation with Simple Hanging Clip at Back QUICK CLEAN - Moisture & Splash Resistant and Easy to Clean with a Dry Cloth', '2024-01-14', 2550, 2, 15, 1, 'sale'),
(17, 'Boho Hanging Art', 'Size	13x9 Inches Product Dimensions	33L x 22.9W Centimeters Item Weight	980 Grams Number of Items	2 Orientation	Portrait Shape	Rectangular Theme	Abstract Recommended Uses For Product	indoor Frame Type	Framed Wall art form	Painting See less About this item GORGEOUS ART SET: This art set creates a striking contemporary look on any wall in your home. Hang together as a group of two or as smaller groupings of your design choice. It\'s a versatile way to display your love of modern art DURABLE & LONG LASTING WITH REUSE CAPABILITIES - High Definition printing, strong clear glass front cover and mdf back panel provide it the strength to last long. Protective Packing- It is well protected with formed-foam corner pockets, Styrofoam, and a box. Order it with confidence! STYLISH DECOR ITEM - They will add meaning to your rooms, filling them with colour and vibrance. They instil good vibes, thoughts and spread positive energy in you and the people around you GIFTING INSPIRATION - It serves as a perfect gift for your loved ones, colleagues and friends. Its longevity and great use would really give them something to remember you by REFLECT YOUR PERSONALITY & ATTITUDE - Let your home and office speak the language you want & reflect the personality you are. Explore more SC CREATIVE designs on Amazon', '2022-07-20', 1500, 2, 2, 1, 'sale'),
(18, ' Multicolor Shades of Green & Yellow Wall Painting', 'Size	17 x 11.5 Inch Product Dimensions	43L x 29W Centimeters Item Weight	200 Grams Number of Items	1 Orientation	Landscape Shape	Rectangular Theme	Landscapes, Abstract Recommended Uses For Product	Home and Living Room Frame Type	Unframed Wall art form	Wall Hanging Decor About this item Wall Art Material - Acrylic | Size - 17x11.5 Inch | Color: Multicolor | Package Contents: 1 X Arcylic Wall Art Leave Your Guests Mesmerized As You Change The Look Of Your Room With Eye-Catchy Wall Art Prints. These Decor Items Come In A Variety Of Themes And Sizes That You Can Choose From. Designed Using Quality Digital Printing Technology To Satisfy Your Aesthetic Taste, We Use Only Quality Digital Print That Is Eco-Friendly. A Perfect Wall Decorations Items Paintings For Living Room, Bedroom, Kitchen, Office, Hotel, Dining Room, Office, Bathroom, Bar Etc. Best Gift Items For Any Occassion Like Diwali Gifts, New Year Gifts, Chirtmas Gifts Etc. Disclaimer - Product Color May Slightly Vary Due To Photographic Lighting Sources Or Your Monitor/Screen Settings. Application Surface Suitable:- Painted and Ceramic Walls, Glossy Wall, Tiles, Unfrosted Glass, Plastic, Plain Wooden Surface, Laminates. (Not Suitable for Bumpy, Grainy Surface, Oily Surface, Wet Walls, Destemper Walls)', '2024-02-01', 3200, 3, 9, 1, 'sale'),
(20, ' Beach  Painting ', 'Item details Handmade Read the full description Materials: Acrylic, Rolled canvas, Painting On Canvas, Canvas Wall Art, Pure hand painted, Acrylic painting, Textured painting, Canvas Wall Decor, Canvas Art, Handmade, Acrylic oil paint, Oil and canvas  Width: 32 inches Height: 64 inches', '2022-06-06', 2890, 1, 5, 1, 'sale'),
(21, 'Original Fish School Painting ', 'Item details Handmade Materials: Acrylic, Rolled Canvas, Canvas Art, Oil and Canvas, Acrylic Oil Paint  Width: 56 inches Height: 28 inches Original Fish School Oil Painting On Canvas, Large Wall Art, Abstract Blue Sea Bottom Painting, Boho Wall Décor, Custom Painting, Home Decor.', '2024-01-28', 4050, 1, 5, 1, 'sale'),
(22, 'Stained Tempered  Round  Art', 'Handmade Materials: glass, tempered glass, Stained Round Glass  Hindu God Shiva Tempered Glass Abstract Wall Art, Tempered Glass Home Decor, Glass Panoramic Wall Decor,Buddhist Decor,House warming Gift Art', '2019-12-25', 4320, 1, 9, 1, 'sale'),
(23, 'Flower sculpture', 'Handmade Materials: Medium: Brass, Copper, Metal Width: 12 inches Height: 20 inches Depth: 10 inches This handmade all metal orchid is both a decorative sculpture and no care orchid alternative. It is a great accent piece for kitchens, living rooms, and bedrooms.', '2023-05-23', 4500, 1, 18, 1, 'sale'),
(24, 'Woman Head Planter face Flower Pot', 'Handmade Width: 4 inches Height: 6 inches Introducing the exotic planter stunningly melting beautiful, one-of-a-kind Head Planter Pots! A exotic planter Artistic planter Perfect for bringing life to any room or patio and adding a touch of class. These 3D printed metallic colors woman melted indoor planter pots will show off your green thumb in style. Regular 6 inches height by 4 inches width approx.X-Large 8 in height by 6 inches  These head woman planters has drainage hole and are an ideal Mother\'s Day gift, showing your appreciation with a special item that will fill any home with life and beauty. Each pot is characterized by its unique shape – resembling a woman\'s head with a hint of oriental grace – and its silky metallic colors, perfect for any pallet. They come in a variety of shapes and designs to choose from, so you can find the perfect planter for any setting.  Whether you’re looking for a flowerpot for your patio table or a desk planter, these head planters are sure to bring a smile to anyone\'s face. The pots are also perfect for gifting as they come ready to fill with soil and your favorite plants. Let your favorite plants thrive inside these beautiful vessels, adding a touch of life to any environment.  When it comes to planters, these head planters are second-to-none for adding a touch of style and elegance to any home or office. Whether you are shopping for the perfect gift for someone special or just looking for the perfect pots for your plants, these head planters are sure to make a statement wherever you decide to put them. Shop confidently knowing you\'re getting something unique and stylish! Unique! the plant is not included  Flowerpot  This exquisite woman melted Head Planter Flower Pot is an ideal choice for those who want to add a unique touch to their home and garden! This 3D Printed Planter will turn heads with its intricate melted woman Medusa face design and will truly stand out from the competition. Constructed from high-quality, durable ma', '2023-04-16', 3000, 1, 21, 1, 'sale'),
(25, 'Kawaii Orange Flower Pot', 'Brighten up any room with this unique and playful orange-shaped flower pot. Made using eco-friendly 3D printing technology and durable PLA materials, this pot is perfect for planting all your favourite flowers and herbs. The pot is designed to look like a sliced half of a juicy orange, adding a touch of fun and freshness to any space.  The pot also comes with a matching water tray shaped like a cutting board, to catch any excess water and help keep your plants healthy. Perfect for both indoor and outdoor use, this orange-shaped flower pot is a great way to add a touch of quirkiness to your home decor.  Available in two sizes: Small - 8cm Height (3.2inches), 8cm Length (3.2inches), 6cm Depth (2.4inches) Large - 11cm Height (4.4inches), 11cm Lenght (4.4inches), 8cm Depth (3.2inches)  This pot is ready to ship, order yours now and add a splash of colour to your home!They are 3D printed out of PLA+ so that layers might be visible but they are individually checked for imperfections and none are being sent as such.  All the products in the shop have been 3D-modelled by me and not downloaded from the internet!  NOTE: They come without plants and gravel!', '2024-02-08', 1403, 1, 21, 1, 'sale'),
(26, ' Mettlach Villeroy & Boch beer mug', 'This exquisite beer mug from Villeroy & Boch, bearing catalog number 1569, is a true collector\'s item. The intricate decorations featuring a dodecagram and octagram showcase the craftsmanship of the late 19th century. The Mettlach factory, founded in 1809 by Johann Boch-Buschman, holds a rich history in ceramic production.  The fusion of the factory with N. Villeroy in 1836 gave rise to the renowned name Villeroy and Boch, symbolizing a legacy of quality and artistry. Despite its age, this mug remains in good condition, with only a minor repair on the handle, as carefully captured in the accompanying photos.  This piece not only serves as a testament to the historical significance of Mettlach but also stands as a testament to the enduring charm of Villeroy & Boch\'s creations. Rest assured, the item will be meticulously packaged to ensure its safe delivery, preserving its unique charm for generations to come.', '1927-02-18', 5000, 1, 21, 1, 'sale'),
(27, 'Dried flowers earrings', 'PRODUCT DETAILS • Studs: stainless steel (nickel free and hypoallergenic) • Hoop diameter: 3.3 cm • Earrings length: 4.5 cm • Sold in pairs • The colors may look slightly different due to the lighting when the pictures were taken', '2022-10-22', 499, 1, 23, 1, 'sale'),
(28, 'flower necklace', 'his pendant was handcrafted in resin. With flowers from \"Forget me not\" Myosotis and Queen\'s lace, they are dried and pressed into a book naturally. It is possible to customize the jewel by changing the \"Queen\'s lace\" background with another color. (Myotosis cannot be replaced). You can purchase the Tiffany green gift package (select from the gift options) The components are made of steel (nickel free). Non-toxic uv resin. Handmade item Materials: acciaio inox, myotosis, non ti scordar di me, resina uv ecological Pendant width: 2.5 Centimetres; Pendant height: 2.5 Centimetres', '2024-01-29', 200, 1, 23, 1, 'sale'),
(29, 'Jasperware *TEATREE* Miniature Plate ', 'On offer is this combination of White Bas relief on the LILAC in the WEDGWOOD Jasper Ware range being part of the AUSTRALIAN FLORA (Banks Series) issued in a Limited Edition in the form of a Miniature Display Plates in 1994. Sorry no box.  This PLATE is attributed to the TEATREE in the white bas relief on the lilac base. The plate has the additional white bas relief on the circumference of the plate in the form of leaves. (Laurel Border)  The Miniature Plate has a diameter of 11.2cm . Fully stamped with the traditional Wedgwood England on the base as pictured.  Offered in excellent pre owned condition with no chips cracks or faults.  A lovely collectable in this combination in Jasper ware.', '2012-08-27', 1499, 3, 20, 1, 'sale'),
(30, '3D shark wall decor', '🦈 3D Shark swimming on the wall. not sticky vinyl or folded paper.It is the perfect 3d shark decor. 💎Features artistic shark wall art Diamond Cut design. I use recyclable materials that are harmless to human health in all my products. You can safely hang the shark in your child\'s room. The product is waterproof. You can use it safely in your bathroom and outdoors. 🏡The shark is visiting your house. 📏It is not 2 dimensional, it is 3 dimensional. It is not folded paper. Take it out of the package to hang on the wall easly. 🧚 The sense of realism is augmented design ', '2023-09-17', 3050, 1, 22, 1, 'sale'),
(35, 'Fancy Resin purple clock', 'size in the photo 75*73cm (height from edge to edge 75cm, round base size 60cm). This is a unique handmade wall decor made of natural stones (moonstone, labradorite), white and a bit of gray and gold. It is available on order. A great gift for any occasion, including birthdays and housewarming.\r\n\r\nThe watch comes with a working mechanism. The base of the clock is made of pressed wood. The reverse side consists of a metal mount on a wooden canvas. The product has a silent mechanism, it needs an AA battery, which is not sent with the watch, because of this, some customs may stop the packaging.\r\n\r\nThe numbers and hands of the watch are made of special gold acrylic. Decorated with various natural stones and crystals.\r\n\r\nIMPORTANT: In order not to damage the clock hands, they are placed separately from the clock. \r\nAvoid excessive UV/sunlight to prevent yellowing of the resin.\r\n\r\nPRODUCT CARE: In order not to scratch the resin, you need to wipe it with microfiber and in no case rub it with aggressive means.\r\n\r\nMATERIALS: MDF, pigments, non-toxic resin, acrylic fittings.', '2023-03-17', 3000, 1, 13, 1, 'sale'),
(36, 'Mandala mirror wood panel', 'Mandala Mirror in Green Color. This is painted on a wood panel and protect with varnishes.  Mandala is full of mini Mirrors and colorful beads. They all create an Unique decoration which will look amazing in every Room.  100% handmade and hand painted ;) 60cm centimeters diameter. On wood panel. It can by hanging or standing decoration.', '2024-01-21', 4000, 1, 14, 8, 'sale'),
(37, 'Resin & Olive Wood Wall Clock', 'Custom Made Resin & Olive Wood Wall Clock, Made to order Epoxy and Olive Wood Wall Clock, Home gift, Live Edge Rustic Olive Wood Wall Clock  The picture is absolutely stunning 16 inches (40cm) resin art clock', '2022-06-13', 4999, 1, 13, 1, 'sale'),
(38, 'mandala purple wall art', 'Beautiful hand painted mand Width: 46 centimetres Height: 46 centimetres Depth: 5 millimetresala. Made with acrylic paints and sealed with a gloss sealant for protection. This is 46 cm and ready to wall hang, a gorgeous addition to any room.', '2022-05-29', 2300, 1, 14, 1, 'sale'),
(39, 'Grow Through What You Go Through ', 'Grow Through What You Go Through calligraphy Wall Art, Positive Quote Decor, Inspirational  Calligraphy Art , Downloadable Retro Decor for Home, Office, School Classroom', '2021-09-30', 300, 3, 2, 8, 'sale'),
(40, 'Golden Elegance  floral masterpiece', '❤This beautiful print wall art which will get you very clean, clear prints. It is perfect for your any room! oil painting size:20*20 ', '2022-04-26', 3000, 1, 5, 1, 'sale'),
(41, 'Bohemian mandala dot art', 'Hand made mandala dot art on 20\" primed MDF board with blue& white combo acrylic paints, minimal diamond shape mirror work and centre clear round mirror 6\"  Width: 20 inches Height: 20 inches Depth: 6 millimetres', '2024-12-01', 7700, 1, 14, 8, 'auction'),
(42, 'Painting of a Beautiful Girl', 'This 30x30cm painting uses vibrant colors and simple strokes to capture her unique vibe. It\'s a real eye-catcher that\'ll look great in any room.', '2015-10-21', 799, 1, 11, 1, 'sale'),
(43, ' moonlit emotions', 'Handmade Materials: Surface: Stretched canvas Width: 8 inches Height: 10 inches', '2017-09-22', 3099, 1, 6, 1, 'sale'),
(44, 'Modern landscape', 'Modern landscape oil painting texture oil painting hand painted custom oil painting wall decor painting bedroom living room decor home gift', '2014-07-23', 2000, 1, 5, 1, 'sale'),
(45, 'Black and White 3D Textured ', 'Black and White Textured Painting,Black and White Wall Art,Black White Abstract Painting,Black and White 3D Textured Wall Art,Home Decor Width: 30 inches Height: 40 inches ', '2020-08-19', 1899, 2, 11, 1, 'sale'),
(46, 'Blooming Cherry Blossoms', 'Blooming Cherry Blossoms textured Painting Hand Painted Knife Painting Waterfall Landscape Canvas Oil Painting Living Room Wall Art  Height: 16 inches Depth: 32 inches', '2019-01-25', 2099, 2, 5, 1, 'sale'),
(47, 'Modern Minimal Neutral ', 'Modern Minimal Neutral Gallery Wall Art Set of 3 Black and Beige Abstract Art Farmhouse Decor Bedroom Wall Art, Living Room Art.', '2024-01-27', 900, 1, 11, 8, 'sale'),
(48, 'pink  3-D flower ', 'Original large size painting, wall art for home and office, Abstract painting, living room painting, bedroom painting. Canvas painting. ＊The painting comes with an EXTRA 2.5-inch white border around it for stretching or framing. ', '2024-02-01', 4340, 1, 5, 1, 'sale'),
(49, 'Mashallah Arabic Calligraphy', 'Mashallah Arabic Calligraphy | Original Hand painted Calligraphy | Islamic wall decor | Islamic Calligraphy Wall art  ', '2015-11-11', 1290, 1, 1, 1, 'sale'),
(50, 'Hasbunallah wa ni’mal-Wakil', 'Handmade Delivery from a small business in India Read the full description Materials:  brushes, gold leaf, charcoal, texture paste, texture tools  Width: 34 inches Height: 24 inches Hasbunallah wa ni’mal-Wakil Calligraphy islamic wall art.Transliteration : \"Hasbunallah wa ni’mal-Wakil”.  Arabic : {‏‏حسبنا الله ونعم الوكيل}.  Translation :\"Allah (Alone) is sufficient for us, and He is the Best Disposer of affairs (for us)\".  ------------------------  According to hadith in Sahih Bukhari, it shows that this dua was sufficient for Prophet Ibrahim (may peace be upon him). It was narrated by Ibn ‘Abbas who said: When (Prophet) Ibrahim (Abraham) was thrown into the fire, he said: “Allah (Alone) is sufficient for us, and, He is the Best Disposer of affairs.” So did Messenger of Allah Muhammad (PBUH) when he was told: “A great army of the pagans had gathered against him, so fear them”. But this (warning) only increased him and the Muslims in Faith and they said: “Allah (Alone) is sufficient for us, and He is the Best Disposer of affairs (for us)”. [Al-Bukhari].  --------------------------- The beauty is neither in the calligraphy nor the artwork, but the Qur\'an itself.  Note: The painting is abstract so you may find the colour strokes different from the original one but the calligraphy or the design or the colours remain same as in the original..  Material: acrylic paint, Varnish, Gold leaf, texture paint ••This painting is original handmade (no printing,no use of machine) ••Original Dimension—24x34 inches (Comes with extra 2 inches border)) ••Surface—Canvas ••Framing___Unframed/Unstretched (if you want stretched or framed please contact me) ••Material; Acrylic paint, Brushes, ••Art name—-Islamic home decor ••Orientation—Horizontal', '2023-03-22', 1499, 1, 1, 8, 'sale'),
(51, 'Sabr Shukr Tawakkul', 'Sabr Shukr Tawakkul | صبر شكر توكل | Patience Gratitude Reliance Arabic HSN Moalla font Calligraphy  It contains a set of 3 minimalist Arabic word art calligraphy.', '2024-01-29', 3090, 2, 1, 1, 'sale'),
(52, 'Bismillah Wall Art', 'Handmade Materials: wood, acrylic  Bismillah Islamic wall art, Islamic Home Decor, Ramadan Decor, Ramadan gifts, Eid gifts, Muslim gift, Islam, Wooden Islamic wall art, Islamic gifts, ramadan decor, Islamic wall decor, Islamic calligraphy, gift for home, housewarming gifts   📌 Material : Wood and acrylic  📌 Color : 5 mm wood and gold or silver acrylic', '2018-04-02', 2000, 1, 1, 1, 'sale'),
(53, 'Archangel Michael ', 'Archangel Michael 27.7cm - 10.90in Religious Statue White Marble & Cast Alabaster Handmade-Handpainted Handmade Materials: Medium: Marble, Stone Width: 7.67 inches Height: 10.9 inches   Dimensions (approximately) Height: 10.90 Inches (27.7cm) Width: 7.67 Inches (19.5cm) Weight: 775gr  Archangel Michael is the only one mentioned in the Bible as an archangel. He is also called \"one of the first lords\" and \"lords\".His name means \"Who (Is) Like God?\" It is believed that it was Brigadier General Michael that angel who appears in the Hebrew Scriptures (Old Testament), and in fact from the first moments of the creation of the world. He was the one who announced to Abraham the need to sacrifice his son, Isaac, and who later prevented it, and the one who appeared to Lot and saved him and his family from the destruction of Sodom. Also, Michael was the one who led the people of Israel to flee from Egypt appearing in the form of a cloud by day and fire by night leading them to the Promised Land. He saved the angelic forces from the fall with \"Let us stand well, let us stand after fear\" and for his parsimony the Triune God gave him the position of \"Lord of the angelic Orders\" In the New Testament, he is the one who will announce the second coming of Jesus Christ and the rapture of His church. He prophetically appears to lead an army of angels in the war in heaven, against \"the great Dragon, the ancient serpent, Satan\" and the demons, where Michael prevails and throws them to earth.   Cast Alabaster Material: Cast Alabaster is a natural crushed stone that gives the feeling of marble, it\'s a solid material water-resistant. Our Alabaster statues were first made in a mold and finished by hand.', '1996-02-15', 3499, 1, 17, 1, 'sale'),
(54, 'Bull Sculpture', 'Bull Sculpture for Home Decor and for Vaastu Showpiece Figurine Abundance Representation Decorative Bull Statue  Handmade Delivery from a small business in India Materials: polyresin Meticulously crafted with attention to detail, this Bull Sculpture exudes a powerful presence. The bull symbolizes attributes such as determination, perseverance, and abundance, making it an excellent choice for those who seek to infuse their living space with these qualities.  Whether you place it on a mantel, a shelf, or as a centerpiece, this sculpture effortlessly becomes a focal point of your decor. Its classic and timeless design blends seamlessly with various interior styles, adding a touch of elegance and cultural significance.  In the realm of Vastu Shastra, the bull, known as Nandi, is considered a guardian and a symbol of divine blessings. Placing this sculpture strategically in your home can be a way to harmonize energy and invite positivity into your living environment.  ', '2011-08-13', 4560, 2, 1, 1, 'sale'),
(55, 'Chinese cloisonne', 'This stunning rare Chinese cloisonné vase. Handcrafted with intricate detail, this jar features beautifully detailed flowers on a crisp white background. Approximately 16cm tall with stand and 18cm wide in diameter, this jar is the perfect size for displaying on a shelf or table. The included wooden stand adds an elegant touch, making it a perfect addition to any room in your home. This vase is in excellent condition.', '1970-04-20', 3999, 1, 19, 1, 'sale'),
(56, 'ay Willfred diu of Andrea Sadek Floral Vessel', 'Vintage from the 1970s Width: 6.5 inches Height: 5.5 inches Jay Willfred diu of Andrea Sadek Floral Vessel made in Philippines. This late 20th century vessel is in good condition. No crazing but small chip in one of the petals on the exterior', '1970-11-21', 4300, 1, 19, 1, 'sale'),
(57, 'Resin Lace Flower Earrings', 'Handmade item  Pendant Size: 50 mm  Material: Metal Plated and real pressed flower', '2024-01-10', 1540, 2, 23, 1, 'sale'),
(58, 'Handmade Plate', 'Handmade Materials: clay  Width: 21 centimetres Height: 3 centimetres Depth: 21 centimetres ', '1988-05-26', 890, 1, 19, 1, 'sale'),
(59, 'Vintage Pottery', 'Vintage from the 1990s Vintage Pottery - Southwestern Pottery - Signed Geo Gonzales  Signed Southwestern pottery. Lovely piece…it has a rough texture with smooth accents. It is signed on the bottom with the name Geo Gonzales. It measures approx. 5 1/2 inches tall and around 6” wide', '1990-07-17', 2598, 1, 21, 1, 'sale'),
(60, 'Elephant on Newspaper', 'Art sketch On: CANVAS Print Size: 10 X 13 inch Frame: Slate Black0.78 inch Finished Size: 11 X 14 inch (27.94 X 35.56 cm)', '2023-12-31', 5023, 3, 8, 8, 'sale'),
(61, 'After A Long', 'Canvas: Artistic matte cotton canvas 410 GSM. Matte finished, crack-resistant, water-resistant, top-coated with an ink-receptive layer.Made of high density polystyrene. Moisture resistant, premium finish, durable and light weight. ', '2022-02-23', 12000, 1, 8, 8, 'auction'),
(62, 'Mecca Skyline Art', 'Size	17 x 11.5 Inch Product Dimensions	43L x 29W Centimeters Item Weight	200 Grams Number of Items	1 Orientation	Landscape Shape	Rectangular Theme	Landscapes, Abstract Recommended Uses For Product	Home and Living Room Frame Type	Unframed Wall art form	Wall Hanging Decor See less About this item Wall Art Material - Acrylic | Size - 17x11.5 Inch | Color: Multicolor | Package Contents: 1 X Arcylic Wall Art Leave Your Guests Mesmerized As You Change The Look Of Your Room With Eye-Catchy Wall Art Prints. These Decor Items Come In A Variety Of Themes And Sizes That You Can Choose From. Designed Using Quality Digital Printing Technology To Satisfy Your Aesthetic Taste, We Use Only Quality Digital Print That Is Eco-Friendly. A Perfect Wall Decorations Items Paintings For Living Room, Bedroom, Kitchen, Office, Hotel, Dining Room, Office, Bathroom, Bar Etc. Best Gift Items For Any Occassion Like Diwali Gifts, New Year Gifts, Chirtmas Gifts Etc. Disclaimer - Product Color May Slightly Vary Due To Photographic Lighting S', '2024-04-22', 100000, 1, 6, 8, 'auction'),
(63, 'Blushing Blues calligraphy', 'Blushing Blues Triptych featuring Ayatul Kursi, Four Quls and the Shahada floating within a blue and blush pink watercolour and ink abstract painting. When grouped together, each piece flows into the next to form one collective piece.  PRODUCT FEATURES • Available on luxurious canvas in three size options. • The original artwork was made by hand and is exclusive to Nirvana Gallery. The item listed is a reproduction of the original artwork • Canvas prints are produced using a giclée printing process to ensure a quality fine art reproduction, which cannot be reproduced with a regular printer. • The canvas is made using finely textured artist-grade cotton material and stretched over a 2-3 cm (0.8-1.2\") thick inner frame with a curved profile', '2024-04-22', 11000, 1, 1, 8, 'auction'),
(64, 'Starry Sky with Planets', 'Matte Poster Option - The art is printed on a high-quality and light-weight rolled matte paper that is optimized for artwork. No frame is provided. ♥ .75\" and 1.25\" Canvas Options - The art is printed using UL-certified Greenguard Gold inks onto a durable cotton and polyester composite canvas. The canvas is then stretched over a .75\" or 1.25\" thick frame made of radial pinewood from FSC certified renewable forests. A sawtooth back hanging is preinstalled, so it\'s ready to hang right away. Two rubber feet on the bottom backside of the canvas ensures the artwork stays in place when hung, protecting the canvas and your wall. ♥ 1.75\" Canvas & Frame Option - For added effect, the 1.25\" Canvas Option comes mounted within a 1.75\" deep black pinewood floater frame, ready to hang immediately once it arrives. The floater frame does not cover or overlap any edges of the canvas. Please note that the added frame will increase both length and width dimensions by about 1.75 inches. For example, the 36x24 inches Size Option will be a total of about 37.75x25.75 inches.', '2024-02-13', 9870, 1, 7, 8, 'sale'),
(65, 'Shri Ram Lalla ', 'Shri Ram Lalla Wall Sculpture - 4.5x2.5ft Great sculpture for your wall. You will feel freedom. A sculpture that will change the atmosphere of your environment.  This sculpture offers perfect home decoration for the living room, bedroom, kitchen, bathroom, dining room, sunroom, man cave, family room, working space, cubicle office, and study.   Sculpture Dimensions: Length: 137 CM Width: 76 CM Depth: 17 CM   Materials: Marble Powder & Fiberglass Non-Breakable & Waterproof', '2024-04-19', 81000, 1, 17, 8, 'auction'),
(66, 'Fine Faience Octagonal Vessel ', 'This eye-catching vintage semi-porcelain vessel, crafted in the Art Nouveau style, originates from Alcobaça, Portugal, and stands as a testament to the skilled artistry of Firmino & Pereira Lda in Palmeira - Alcobaça. Dating back to the second half of the 20th century, this captivating piece showcases an oriental design with a mesmerizing blue peacock image.  The octagonal vessel is adorned with intricate hand-painted details, featuring the iconic blue peacock against a backdrop of rich red and gold accents. Characterized by its fine tin-glazed pottery, the vessel adds a touch of elegance to its overall aesthetic.  With no lid, this Vintage Vase stands as a unique and eye-catching piece of Portuguese pottery. Its Alcobaça origin lends historical and cultural significance, while the inclusion of gold accents further enhances its allure. This timeless creation beautifully embodies the essence of vintage porcelain, making it a noteworthy addition to any collector\'s repertoire.  There are invisible cracks in the glaze on the surface that become apparent only upon close inspection. I tried to photograph these cracks. Please look at the photo.  The item is marked with the manufacturer\'s insignia and the number \"7\".  Height: 19 cm / 7.5 inches Width: 14 cm / 5.5 inches', '2024-04-16', 9940, 1, 19, 8, 'sale'),
(67, 'wood mandala', 'Stone & Wood Mandala Invite the soothing energy of nature into your living space with our Stone & Wood Mandala, a mesmerizing circular canvas adorned with meticulously arranged stones and wooden pieces. Embrace the harmonious fusion of organic textures and geometric patterns, creating a striking centerpiece that resonates with the essence of tranquility and balance.  Find the ideal spot to showcase this Stone & Wood Mandala in your living room, bedroom, or study. Its unique blend of raw natural elements and artistic finesse complements various interior styles, from boho chic to modern minimalist.  Add a touch of serenity and natural charm to your home decor with our Stone & Wood Mandala. Ideal for yoga studios, meditation spaces, or any room where you seek to create a tranquil atmosphere.  Made to bring art-gallery quality to exhibiting artwork in any space, these custom acrylic prints are the perfect means to show art to the world. These prints are water-resistant and effortless to maintain clean like new thanks to their 0.25\"-thick, Grade-A acrylic material. Each print comes with a French cleat backing and installation screws, for easy and secure hanging.  .: 12″ x 12″ (Square) .: Material: 0.25” thick grade-A acrylic with white vinyl backing .: Available in 5 sizes .: Horizontal and vertical options .: Hand-polished, crystal clear edges .: Fitted with french cleat backing for easy and secure hanging .: Screws for installing the hanging included', '2024-03-11', 14000, 1, 14, 8, 'sale'),
(68, 'green geode ', 'mmerse yourself in the lush beauty of this captivating green resin artwork adorned with exquisite gold accents. The rich emerald tones evoke a sense of tranquility, reminiscent of a hidden forest oasis. Glimmering gold accents dance across the surface, adding a touch of opulence and elegance to the composition.  Embedded within the layers are delicate fragments of crushed glass, creating a mesmerizing interplay of texture and light. Each shard reflects and refracts, contributing to the dynamic and enchanting allure of the piece.  Six carefully placed quartz crystals emerge like treasures within the resin sea, their natural formations adding a touch of earthy magic. These crystals, with their ethereal energy, invite contemplation and connection.  This artwork is a harmonious blend of nature’s hues, elevated by the luxurious gleam of gold and the mystical energy of quartz crystals. Transform your space with this unique creation that transcends artistry, inviting you to explore the serene depths and radiant highlights of a verdant dreamscape.  This piece is 24” across.', '2024-11-20', 7000, 1, 12, 8, 'auction'),
(69, 'eal & Pink Drop Earrings', 'This pair of resin earrings have unique pattern, eye-catching and elegant.  These earrings are made with a colorful resin with complementary gold designs to create a unique and eye-catching piece of jewelry. The lightweight hoops are comfortable enough to wear all day.  This modern pair of earrings is supplied with a jewelry pouch for safe keeping.', '2024-03-04', 1000, 1, 23, 8, 'sale');

-- --------------------------------------------------------

--
-- Table structure for table `art_image`
--

CREATE TABLE `art_image` (
  `art_image_id` int(11) NOT NULL,
  `art_image` varchar(150) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `art_image`
--

INSERT INTO `art_image` (`art_image_id`, `art_image`, `art_id`) VALUES
(2, 'images/allah.jpg', 2),
(5, 'images/shri ganesh1.jpg', 5),
(6, 'images/Art Factory Landscape Ganesha Canvas Painting (Multicolour).jpg', 5),
(7, 'images/Ganeshji.jpg', 5),
(8, 'images/resin black c1.jpg', 6),
(9, 'images/resin black c2.jpg', 6),
(10, 'images/resin black c1.jpg', 6),
(11, 'images/round wall art.jpg', 4),
(12, 'images/raam charan.jpg', 7),
(13, 'images/Naruto & Kurama.jpg', 8),
(14, 'images/om1.png', 13),
(15, 'images/om2.png', 13),
(16, 'images/om3.png', 13),
(17, 'images/buddha.png', 14),
(18, 'images/paper plain design1.png', 15),
(19, 'images/paper plain design2.png', 15),
(20, 'images/lion1.png', 16),
(21, 'images/lion2.png', 16),
(22, 'images/love1.png', 17),
(23, 'images/love2.png', 17),
(24, 'images/Wall Art Painting1.png', 18),
(25, 'images/Wall Art Painting2.png', 18),
(28, 'images/beach1.png', 20),
(29, 'images/beach2.png', 20),
(30, 'images/fishhouse1.png', 21),
(31, 'images/fishhouse2.png', 21),
(32, 'images/tempered glass.png', 22),
(33, 'images/flower sculpture1.png', 23),
(34, 'images/flower sculpture 2.png', 23),
(35, 'images/flower sculpture 3.png', 23),
(36, 'images/wooden girl head.png', 24),
(37, 'images/orange pot1.png', 25),
(38, 'images/orange pot2.png', 25),
(39, 'images/aesthetic 1.png', 26),
(40, 'images/aesthetic 2.png', 26),
(41, 'images/resin earing1.png', 27),
(42, 'images/resin earing 2.png', 27),
(43, 'images/flower necklace 1.png', 28),
(44, 'images/flower necklace 2.png', 28),
(45, 'images/jasperware1.png', 29),
(46, 'images/jasperware2.png', 29),
(47, 'images/shark1.png', 30),
(57, 'images/purple clock1.png', 35),
(58, 'images/green mandala1.png', 36),
(59, 'images/green mandala2.png', 36),
(60, 'images/green mandala 3.png', 36),
(61, 'images/wood blue clock1.png', 37),
(62, 'images/wood blue clock 2.png', 37),
(63, 'images/purple mandala 1.png', 38),
(64, 'images/purple mandala2.png', 38),
(65, 'images/quote brush call.png', 39),
(66, 'images/golden flower1.png', 40),
(67, 'images/golden flower2.png', 40),
(68, 'images/dot mandala3.png', 41),
(69, 'images/dot mandala2.png', 41),
(70, 'images/dot mandala1.png', 41),
(71, 'images/Painting of a Beautiful Girl1.png', 42),
(72, 'images/Painting of a Beautiful Girl2.png', 42),
(73, 'images/Abstract moonlit emotions.png', 43),
(74, 'images/Modern landscape1.png', 44),
(75, 'images/Modern landscape2.png', 44),
(76, 'images/Black and White 3D Textured 1.png', 45),
(77, 'images/Black and White 3D Textured 2.png', 45),
(78, 'images/Blooming Cherry Blossoms1.png', 46),
(79, 'images/Blooming Cherry Blossoms2.png', 46),
(80, 'images/Modern Minimal Neutral 1.png', 47),
(81, 'images/Modern Minimal Neutral.png', 47),
(82, 'images/pink  3-D flower 2.png', 48),
(83, 'images/pink  3-D flower.png', 48),
(84, 'images/pink  3-D flower 3.png', 48),
(85, 'images/Mashallah Arabic Calligraphy.png', 49),
(86, 'images/Hasbunallah waniamal wakeel1.png', 50),
(87, 'images/Hasbunallah waniamal wakeel2.png', 50),
(88, 'images/Sabr Shukr Tawakkul1.png', 51),
(89, 'images/Sabr Shukr Tawakkul2.png', 51),
(90, 'images/Bismillah Wall Art1.png', 52),
(91, 'images/Bismillah Wall Art2.png', 52),
(92, 'images/Archangel Michael 1.png', 53),
(93, 'images/Archangel Michael 2.png', 53),
(94, 'images/bull sculpture1.png', 54),
(95, 'images/bull sculpture 2.png', 54),
(96, 'images/Chinese cloisonne1.png', 55),
(97, 'images/Chinese cloisonne2.png', 55),
(98, 'images/Floral Vessel1.png', 56),
(99, 'images/Floral Vessel2.png', 56),
(100, 'images/Floral Vessel3.png', 56),
(101, 'images/Resin Lace Flower Earrings.png', 57),
(102, 'images/Resin Lace Flower Earrings1.png', 57),
(103, 'images/HANDMADE PLATE1.png', 58),
(104, 'images/HANDMADE PLATE2.png', 58),
(105, 'images/HANDMADE PLATE3.png', 58),
(106, 'images/Vintage Pottery1.png', 59),
(107, 'images/Vintage Pottery2.png', 59),
(108, 'images/Vintage Pottery3.png', 59),
(109, 'images/elephat.png', 60),
(110, 'images/bhalu.png', 61),
(111, 'images/mecca1.png', 62),
(112, 'images/mecca2.png', 62),
(113, 'images/mecca3.png', 62),
(114, 'images/blushing blue.png', 63),
(115, 'images/starry sky moon.png', 64),
(116, 'images/ram lalla.png', 65),
(117, 'images/vase antique.png', 66),
(118, 'images/wood mandala.png', 67),
(119, 'images/geode.png', 68),
(120, 'images/teal and drop.png', 69);

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `bid_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `start_bid_amt` int(11) NOT NULL,
  `start_bid_date` date NOT NULL,
  `end_bid_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_amt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`bid_id`, `art_id`, `start_bid_amt`, `start_bid_date`, `end_bid_date`, `user_id`, `bid_amt`) VALUES
(1, 5, 300, '2023-12-25', '2023-12-28', 11, 800),
(2, 4, 500, '2023-08-20', '2023-08-22', 12, 1000),
(3, 62, 9000, '2024-02-26', '2024-03-04', 11, 100000),
(4, 66, 23400, '2024-03-10', '2024-03-17', 11, 23400),
(5, 66, 23400, '2024-03-10', '2024-03-17', 11, 35400),
(6, 66, 23400, '2024-03-10', '2024-03-17', 11, 99400),
(7, 65, 21000, '2024-03-15', '2024-03-22', 11, 21000),
(8, 65, 21000, '2024-03-15', '2024-03-22', 11, 23000),
(9, 65, 21000, '2024-03-15', '2024-03-22', 11, 21000),
(10, 65, 21000, '2024-03-15', '2024-03-22', 11, 81000),
(12, 68, 5000, '2024-04-21', '2024-04-28', 11, 6000),
(13, 63, 7000, '2024-04-22', '2024-04-29', 11, 8000),
(14, 63, 7000, '2024-04-22', '2024-04-29', 11, 9000),
(15, 68, 5000, '2024-04-21', '2024-04-28', 11, 7000),
(16, 63, 7000, '2024-04-22', '2024-04-29', 11, 10000),
(17, 63, 7000, '2024-04-22', '2024-04-29', 11, 11000),
(18, 41, 7700, '2024-12-09', '2024-12-16', 11, 7700);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_art_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `art_id`, `user_id`, `cart_art_qty`) VALUES
(74, 4, 14, 2),
(75, 2, 14, 1),
(88, 29, 8, 1),
(160, 41, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(2, 'Paintings'),
(6, 'Sculpture '),
(7, 'Calligraphy'),
(8, 'Resin art'),
(10, 'Sketching'),
(11, 'Fine Art Ceramics');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'adoni', 3),
(2, 'badvel', 3),
(3, 'bepatla', 3),
(4, 'sallur', 3),
(5, 'amguri', 4),
(6, 'dhing', 4),
(7, 'nalbari', 4),
(8, 'sonari', 4),
(9, 'dibang valley', 5),
(10, 'East Siang', 5),
(11, 'Andheri', 20),
(12, 'Artist village', 20),
(13, 'Bandra', 20),
(14, 'Ghatkopar', 20),
(15, 'Goregaon', 20),
(16, 'juhu', 20),
(17, 'Thane', 20),
(18, 'Gandhinagar', 1),
(19, 'Ahmedabad', 1),
(20, 'Adalaj', 1),
(21, 'Himatnagar', 1),
(22, 'Prantij', 1),
(23, 'Delhi', 10),
(24, 'Chennai', 28),
(25, 'vadodra', 1),
(26, 'Banglore', 15),
(27, 'Mumbai', 20),
(28, 'Coimbatore', 28);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL,
  `feedback_date` datetime NOT NULL,
  `feedback` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `art_id`, `feedback_date`, `feedback`) VALUES
(2, 8, 29, '2024-03-03 14:33:45', 'Nice plate'),
(3, 11, 18, '2024-03-04 04:56:50', 'This is a very good product'),
(4, 11, 6, '2024-03-12 06:18:02', 'gse'),
(5, 11, 5, '2024-04-22 20:15:25', 'Great peice of art'),
(6, 11, 4, '2024-04-23 07:05:59', 'Nice art'),
(7, 11, 5, '2024-04-23 14:43:00', 'Very creative art piece ');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_amt` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_amt`) VALUES
('order_Nfthr8xKzhKf2b', 11, '2024-02-27', 4447.00),
('order_NfvQvpw60pRHkq', 11, '2024-02-27', 2930.00),
('order_NfvYOOaWFQ4kTo', 11, '2024-02-27', 3200.00),
('order_NfwLgMqqCPj9xL', 11, '2024-02-27', 2000.00),
('order_NhZTEvG9KcvUGz', 8, '2024-03-02', 3039.00),
('order_Ni3BfDOVERTPc9', 11, '2024-03-03', 1049.00),
('order_NlK7npGdVJDoMa', 11, '2024-03-12', 8795.00),
('order_NlLYkAOYw4CIvO', 11, '2024-03-12', 26998.00),
('order_NlWHWVWsWqbfbN', 11, '2024-03-12', 899.00),
('order_NnQwiprPOQwc3x', 11, '2024-03-17', 1698.00),
('order_O1wo8YEXCPH1Do', 11, '2024-04-23', 899.00),
('order_O27giWaAHwmBXA', 11, '2024-04-23', 3396.00),
('order_O2L69CwOca2mBI', 11, '2024-04-24', 8799.00),
('order_P0JxdEaXGtMvtY', 11, '2024-09-22', 8799.00),
('order_PRq2hp5LE47Mcl', 11, '2024-12-01', 1049.00),
('order_PRqp2Gz9VMa27c', 11, '2024-12-01', 1799.00),
('order_PVAgjZyczpADsA', 11, '2024-12-09', 7000.00),
('order_PVNQPEHwadXrHH', 11, '2024-12-10', 1799.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` varchar(20) NOT NULL,
  `art_id` int(11) NOT NULL,
  `order_art_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `art_id`, `order_art_qty`) VALUES
('order_Nfthr8xKzhKf2b', 4, 2),
('order_Nfthr8xKzhKf2b', 5, 1),
('order_NfvQvpw60pRHkq', 6, 1),
('order_NfvQvpw60pRHkq', 15, 1),
('order_NfvYOOaWFQ4kTo', 18, 1),
('order_NfwLgMqqCPj9xL', 13, 1),
('order_NhZTEvG9KcvUGz', 29, 1),
('order_NhZTEvG9KcvUGz', 57, 1),
('order_Ni3BfDOVERTPc9', 2, 1),
('order_NlK7npGdVJDoMa', 8, 2),
('order_NlK7npGdVJDoMa', 14, 1),
('order_NlK7npGdVJDoMa', 29, 2),
('order_NlLYkAOYw4CIvO', 4, 2),
('order_NlLYkAOYw4CIvO', 66, 1),
('order_NlWHWVWsWqbfbN', 5, 1),
('order_NnQwiprPOQwc3x', 5, 2),
('order_O1wo8YEXCPH1Do', 5, 1),
('order_O27giWaAHwmBXA', 5, 4),
('order_O2L69CwOca2mBI', 4, 1),
('order_O2L69CwOca2mBI', 68, 1),
('order_P0JxdEaXGtMvtY', 4, 1),
('order_P0JxdEaXGtMvtY', 68, 1),
('order_PRq2hp5LE47Mcl', 2, 1),
('order_PRqp2Gz9VMa27c', 4, 1),
('order_PVAgjZyczpADsA', 68, 1),
('order_PVNQPEHwadXrHH', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(20) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `mode_pay` varchar(50) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `pay_date`, `mode_pay`, `order_id`) VALUES
('pay_Nfti3yFBnDz7Lc', '2024-02-27', 'undefined', 'order_Nfthr8xKzhKf2b'),
('pay_NfvRBEdnmbCwGJ', '2024-02-27', 'undefined', 'order_NfvQvpw60pRHkq'),
('pay_NfvYcgvz3QtmEg', '2024-02-27', 'undefined', 'order_NfvYOOaWFQ4kTo'),
('pay_NfwMLrcab2K5uK', '2024-02-27', 'undefined', 'order_NfwLgMqqCPj9xL'),
('pay_NhZU27bWfwD12v', '2024-03-02', 'undefined', 'order_NhZTEvG9KcvUGz'),
('pay_Ni3E45kEg66zgV', '2024-03-03', 'Online', 'order_Ni3BfDOVERTPc9'),
('pay_NlK84nHMvjTc7S', '2024-03-12', 'Online', 'order_NlK7npGdVJDoMa'),
('pay_NlLZLncxaN4pRY', '2024-03-12', 'Online', 'order_NlLYkAOYw4CIvO'),
('pay_NlWHu1EYxCaSXE', '2024-03-12', 'Online', 'order_NlWHWVWsWqbfbN'),
('pay_NnQxFueuHG7anb', '2024-03-17', 'Online', 'order_NnQwiprPOQwc3x'),
('pay_O1woVKdIOtcDTx', '2024-04-23', 'Online', 'order_O1wo8YEXCPH1Do'),
('pay_O27nAzqp1KoUak', '2024-04-23', 'Online', 'order_O27giWaAHwmBXA'),
('pay_O2L6hnur4nJoR4', '2024-04-24', 'Online', 'order_O2L69CwOca2mBI'),
('pay_P0JyWLeisVuuRE', '2024-09-22', 'Online', 'order_P0JxdEaXGtMvtY'),
('pay_PRq3AWRlZUzUBt', '2024-12-01', 'Online', 'order_PRq2hp5LE47Mcl'),
('pay_PRqpisauDoTcBw', '2024-12-01', 'Online', 'order_PRqp2Gz9VMa27c'),
('pay_PVAitjUswbRcTs', '2024-12-09', 'Online', 'order_PVAgjZyczpADsA'),
('pay_PVNQh6yuuHsaZe', '2024-12-10', 'Online', 'order_PVNQPEHwadXrHH');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `ship_id` int(11) NOT NULL,
  `ship_status` varchar(20) NOT NULL,
  `delivery_date` date NOT NULL,
  `order_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`ship_id`, `ship_status`, `delivery_date`, `order_id`) VALUES
(3, 'Shipped', '2024-03-03', 'order_Nfthr8xKzhKf2b'),
(4, 'Out for delivery', '2024-03-03', 'order_NfvQvpw60pRHkq'),
(5, 'Pending', '2024-03-03', 'order_NfvYOOaWFQ4kTo'),
(6, 'Pending', '2024-03-03', 'order_NfwLgMqqCPj9xL'),
(7, 'delivered', '2024-03-07', 'order_NhZTEvG9KcvUGz'),
(8, 'Pending', '2024-03-08', 'order_Ni3BfDOVERTPc9'),
(9, 'Pending', '2024-03-17', 'order_NlK7npGdVJDoMa'),
(10, 'Pending', '2024-03-17', 'order_NlLYkAOYw4CIvO'),
(11, 'Pending', '2024-03-17', 'order_NlWHWVWsWqbfbN'),
(12, 'Pending', '2024-03-22', 'order_NnQwiprPOQwc3x'),
(13, 'Pending', '2024-04-28', 'order_O1wo8YEXCPH1Do'),
(14, 'Pending', '2024-04-28', 'order_O27giWaAHwmBXA'),
(15, 'Shipped', '2024-04-29', 'order_O2L69CwOca2mBI'),
(16, 'Pending', '2024-09-27', 'order_P0JxdEaXGtMvtY'),
(17, 'Pending', '2024-12-06', 'order_PRq2hp5LE47Mcl'),
(18, 'Pending', '2024-12-06', 'order_PRqp2Gz9VMa27c'),
(19, 'Pending', '2024-12-14', 'order_PVAgjZyczpADsA'),
(20, 'Pending', '2024-12-15', 'order_PVNQPEHwadXrHH');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Gujarat'),
(2, 'uttarakhand'),
(3, 'Andhra pradesh'),
(4, 'Assam'),
(5, 'Arunachal pradesh'),
(6, 'Bihar'),
(7, 'Chandigarh'),
(8, 'Jammu & kashmir'),
(9, 'tripura'),
(10, 'delhi'),
(11, 'goa'),
(12, 'haryana'),
(13, 'Himachal pradesh'),
(14, 'jharkhand'),
(15, 'karnataka'),
(16, 'kerala'),
(17, 'ladakh'),
(18, 'lakhshwadeep'),
(19, 'madhya pradesh'),
(20, 'maharashtra'),
(21, 'manipur'),
(22, 'meghalaya'),
(23, 'mizoram'),
(24, 'nagaland'),
(25, 'puducherry'),
(26, 'rajasthan'),
(27, 'sikkim'),
(28, 'tamil nadu'),
(29, 'telangana'),
(30, 'uttarpradesh');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(30) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_cat_id`, `sub_cat_name`, `cat_id`) VALUES
(1, 'Arabic calligraphy', 7),
(2, 'Brush calligraphy', 7),
(5, 'Oil painting', 2),
(6, 'Acrylic painting', 2),
(7, 'Spray painting', 2),
(8, 'portrait sketching', 10),
(9, 'Glass painting', 2),
(10, 'panel painting', 2),
(11, 'Abstact Art', 2),
(12, ' resin wall art', 8),
(13, 'resin clock', 8),
(14, 'mandala art', 2),
(15, 'nature painting', 2),
(16, 'sanskrit calligraphy', 7),
(17, 'Figurine', 6),
(18, 'Art Objects', 6),
(19, 'Vessels', 6),
(20, 'Jasperware', 11),
(21, 'Wooden Pots', 11),
(22, '3D sculpture', 6),
(23, 'resin jwellery', 8);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_pic` varchar(250) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `contact_no` bigint(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `security_question` varchar(70) NOT NULL,
  `security_answer` varchar(70) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(150) NOT NULL,
  `city_id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `gender`, `profile_pic`, `username`, `email_address`, `contact_no`, `password`, `security_question`, `security_answer`, `date_of_birth`, `address`, `city_id`, `pincode`, `user_type`) VALUES
(1, 'john', 'sharma', 'male', NULL, 'johnnyy', 'john@gmail.com', 9712345611, '@johnny123', 'What is the name of your favorite pe', 'domm', '2018-05-22', '23, Garden view, Nehrunagar,Banglore', 26, 560001, 'artist'),
(2, 'preeti', 'patel', 'female', NULL, 'preety_patel', 'preeti@gmail.com', 8734217743, 'blahblahblah123', 'What is your favorite movie?', 'chakde India', '2023-12-03', '45 Green Avenue, Gandhinagar, Ahmedabad', 2, 383002, 'artist'),
(3, 'rishita', 'patal', 'female', 'Pin on Aesthetic.jpg', 'rishhi', 'rishhi37@gmail.com', 9898125123, 'rishi1234', 'afraid of?', 'darkness', '1991-06-06', '43 Vasai Municipal Indl Estate, Umela Phata, Papadi, Papdi', 17, 401207, 'artist'),
(4, 'ruhiyanka', 'bhalla', 'female', 'pro1.jpg', 'ruhii', 'ruhiyanka@gmail.com', 9721432527, 'ruhii1234', 'color of your hair?', 'black', '2005-07-03', 'Nr Ashish Cinema, Odhavuri Kalan', 19, 382415, 'customer'),
(5, 'ishita ', 'kulkarni', 'female', 'pro2.jpg', 'ishuuu', 'ishu@gmail.com', 9549119889, 'ishitaraguu123', 'yess', 'no', '1998-05-02', '1374/8, Katra Lehaswan, Mahalaxmi Market, Chandni Chowk', 23, 110006, 'artist'),
(6, 'Aditya', 'rathore', 'male', 'pro3.jpg', 'adiiiii34', 'adi@gmail.com', 7455060450, 'mrperfect543211', 'yess', 'no', '2009-08-21', '50/11, 2 Main R Nagar Industrial Tn, West Of Chord Road', 26, 56004, 'artist'),
(8, 'Raj', 'Pandya', 'on', 'images/WhatsApp Image 2024-01-26 at 10.17.36_69f7a96b.jpg', 'Rajyo', 'devlopanchal87@gmail.com', 950448090, 'Dev2610@', 'yess', 'no', '2003-07-03', 'anjuman street pologround', 21, 383001, 'artist'),
(11, 'dev', 'panchal', 'on', NULL, 'dev', 'devpanchal2610@gmail.com', 9316510024, 'Dev2610@', 'yess', 'no', '2004-10-26', '54,Rajmahal Bunglows,Sahakari Jin Road', 21, 383001, 'customer'),
(12, 'chandresh', 'thakkar', 'on', 'images/chandresh.jpg', 'chandresh_05', 'chandreshthakkar9090@gmail.com', 9574699898, 'ch123', 'yess', 'no', '2003-05-11', 'B-104, Binori Sonnet, Nr. Government Tubewell, Bopal, Ahmedabad', 19, 3830058, 'customer'),
(14, 'Nidhi', 'Panchal', 'female', 'images/20210429182430_IMG_9239.JPG', 'nidhu@123', 'nidhi@gmail.com', 1234567891, 'Nidhi2707@', 'what is your father name?', 'Arjanbhai', '2004-07-27', 'Vastrapur', 19, 380060, 'customer'),
(15, 'artibidz', 'auction', 'male', 'images/artibidz-logo2.png', 'artibidz@123', 'artibidz@gmail.com', 9874563215, 'Artibidz2610@', 'Hello', 'Hi', '2024-03-01', '', 19, 380059, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `art`
--
ALTER TABLE `art`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sub_cat_id` (`sub_cat_id`);

--
-- Indexes for table `art_image`
--
ALTER TABLE `art_image`
  ADD PRIMARY KEY (`art_image_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `art_id` (`art_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_art` (`art_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `art_id` (`art_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`art_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ship_id`),
  ADD KEY `fk_order_id_ship` (`order_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `contact_no` (`contact_no`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `art`
--
ALTER TABLE `art`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `art_image`
--
ALTER TABLE `art_image`
  MODIFY `art_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `bid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `art`
--
ALTER TABLE `art`
  ADD CONSTRAINT `art_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `art_ibfk_2` FOREIGN KEY (`sub_cat_id`) REFERENCES `sub_category` (`sub_cat_id`);

--
-- Constraints for table `art_image`
--
ALTER TABLE `art_image`
  ADD CONSTRAINT `art_image_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`);

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`),
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_art` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `art` (`art_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `fk_order_id_ship` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
