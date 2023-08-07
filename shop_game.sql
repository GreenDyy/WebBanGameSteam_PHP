-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2023 at 09:20 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int NOT NULL,
  `id_user` int NOT NULL,
  `code_cart` int NOT NULL,
  `cart_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `code_cart`, `cart_status`) VALUES
(2, 3, 8760, 1),
(24, 1, 4776, 0),
(29, 4, 8907, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `code_cart` int NOT NULL,
  `id_game` int NOT NULL,
  `quantity` int NOT NULL,
  `total_price` double NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`code_cart`, `id_game`, `quantity`, `total_price`, `address`) VALUES
(4776, 4, 3, 750000, 'c7/90 Hà Nội'),
(4776, 5, 3, 366000, 'c7/90 Hà Nội'),
(4776, 6, 2, 100000, 'c7/90 Hà Nội'),
(8760, 17, 3, 270000, 'TP HCM'),
(8907, 6, 3, 150000, 'tầng 3, lê lợi, quận 1'),
(8907, 17, 4, 360000, 'tầng 3, lê lợi, quận 1'),
(8907, 18, 2, 1580000, 'tầng 3, lê lợi, quận 1');

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` double NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'ASTRONEER', 'Khám phá không gian và quản lý tài nguyên có lẽ không phải là một thể loại quá xa lạ trên thị trường. Nhưng mỗi khi nghĩ đến thể loại này là tôi lại nhớ đến “thảm họa” ngày xưa của No Man’s Sky, nên khá dè dặt khi quyết định trải nghiệm Astroneer. Trò chơi từng phát hành Early Access / Game Preview lần lượt trên hai nền tảng Windows và Xbox One khá lâu. Mãi đến gần đây thì tựa game này mới chính thức phát hành trên cả hai nền tảng nói trên và tôi mới có dịp trải nghiệm tựa game này.\r\nAstroneer đưa người chơi đến với bối cảnh cơn sốt vàng ở thời điểm thế kỷ 25. Người chơi là một trong số những kẻ muốn tìm kiếm cơ hội đổi đời ngoài không gian vũ trụ, khai thác các tài nguyên quý giá từ các hành tinh với công cụ có khả năng định hình thế giới, thay đổi địa hình. Tài nguyên có thể dùng để trao đổi hoặc chế tạo thành những công cụ, phương tiện hoặc module mới để tạo nên mọi thứ, từ những căn cứ công nghiệp khổng lồ cho đến những cơ sở di động.\r\n\r\nLối chơi của Astroneer không mới, nhưng cách xây dựng game mang đến cảm giác khá thư giãn với phần điều khiển đơn giản và dễ tiếp cận. Nhân vật của người chơi được thể hiện ở góc nhìn thứ ba, kết hợp với các yếu tố sinh tồn và chế đồ thông qua một trải nghiệm sandbox hấp dẫn. Tuy nhiên, điểm trừ đầu tiên của game là phần Tutorial khiến tôi cảm thấy khá lúng túng. Trò chơi không hề hướng dẫn chi tiết các yếu tố gameplay, mà chỉ đơn giản yêu cầu bạn thực hiện các nhiệm vụ cho mục đích này với vài chỉ dẫn khá ngắn gọn, gây khó hiểu. Nhất là trường hợp bạn không chịu khó khám phá môi trường màn chơi, tìm hiểu kỹ hơn nhiệm vụ phải làm trong phần chơi này là gì.', 190000, 'astroneer.jpg'),
(2, 'Quest Hunter', 'Chào mừng đến với Dark World. Thế giới được cai trị bởi luật riêng của nó. Thế giới nơi lửa là kho báu chính, và một chiếc xẻng là người bạn và người trợ lý trung thành. Những nhân vật phản diện ở đây thì mang lại vô vàn rắc rối còn những vấn đề cần quan tâm anh hùng thì vô cùng đau đầu. Là một anh hùng, bạn sẽ phải:\r\n\r\nNâng cấp và trang bị cho bản thân.\r\nChiếm một số lãnh thổ cho trại của bạn từ Dark World.\r\nTập hợp một nhóm bạn bè và những người giúp đỡ.\r\nXây dựng và bảo vệ trại của bạn.\r\nGiải quyết các câu đố cổ xưa.\r\nPhá hủy những kế hoạch xảo quyệt của kẻ thù.\r\nTìm và khai quật nhiều kho báu.\r\nCứu công chúa và cả thế giới nữa chứ?!\r\nQuest Hunter là một game RPG với truy tìm kho báu, đối thoại phi tuyến tính,  những câu đố hóc búa và cực kì vui! Thế giới bí ẩn, cốt truyện hấp dẫn, những câu đố thú vị và những kẻ thù xảo quyệt đang chờ bạn! ', 260000, 'questhunter.jpg'),
(3, 'Slime Rancher', 'Slime Rancher là một trải nghiệm hộp cát quyến rũ, góc nhìn thứ nhất. Vào vai Beatrix LeBeau: một chủ trang trại trẻ tuổi, may mắn, người bắt đầu cuộc sống cách xa Trái đất một nghìn năm ánh sáng trên ‘Far, Far Range.’\r\n\r\nMỗi ngày sẽ đưa ra những thách thức mới và cơ hội rủi ro khi bạn cố gắng tích lũy một khối tài sản lớn trong việc kinh doanh trang trại slime. Thu thập các chất nhờn đầy màu sắc, trồng trọt, thu hoạch tài nguyên và khám phá những vùng hoang dã chưa được thuần hóa thông qua việc làm chủ túi đồ đa năng của bạn.', 188000, 'slime.jpg'),
(4, 'Subnautica', 'Subnautica là một trò chơi phiêu lưu, khám phá, thế giới mở ở dưới nước được đặt trên một hành tinh đại dương ngoài hành tinh. Một thế giới rộng mở, tự do và nguy hiểm đang chờ đón bạn!\r\nKhi vào game bạn sẽ rơi xuống một thế giới đại dương ngoài hành tinh, các đại dương của Subnautica trải dài từ các rặng san hô cạn mặt trời đến các rãnh đào sâu dưới biển, các mỏ dung nham và các dòng sông dưới nước phát quang sinh học. Quản lý nguồn cung cấp oxy của bạn khi bạn khám phá rừng tảo bẹ, cao nguyên, rạn san hô và các hệ thống hang động quanh co dưới đáy đại dương. Bạn cần tìm kiếm, thu thập thức ăn và phát triển thiết bị để khám phá. Thu thập tài nguyên từ đại dương xung quanh bạn, thiết bị lặn, đèn chiếu sáng, môi trường sống, tìm các tài nguyên hiếm hơn, cho phép bạn tạo ra các vật phẩm cao cấp hơn\r\n\r\nXây dựng căn cứ dưới đáy biển. Chọn vị trí, bố trí các thành phần, và quản lý toàn vẹn thân tàu cũng như như chiều sâu và áp lực. Sử dụng cơ sở của bạn để lưu trữ tài nguyên, xe, công viên và bổ sung nguồn cung cấp oxy khi bạn khám phá đại dương rộng lớn.', 250000, 'subnautica.jpg'),
(5, 'Ori and the Blind Forest', 'Khu rừng của Nibel đang chết dần. Sau một cơn bão mạnh tạo ra một loạt các sự kiện tàn khốc trong chuyển động, Ori phải hành trình tìm kiếm sự can đảm và đối mặt với một kẻ thù đen tối để cứu khu rừng Nibel. Bản tình ca Ori and the Blind Forest kể về một đứa trẻ mồ côi được định sẵn cho các anh hùng, thông qua một Action-Platformer trực quan tuyệt đẹp được chế tạo bởi Moon Studios. Với tác phẩm nghệ thuật vẽ tay, diễn xuất nhân vật hoạt hình tỉ mỉ, điểm số được phối hợp đầy đủ và hàng tá tính năng mới trong  Definitive Edition; Ori and the Blind Forest, khám phá một câu chuyện đầy cảm xúc về tình yêu và sự hy sinh, và hy vọng tồn tại trong tất cả chúng ta', 122000, 'ori.jpg'),
(6, 'Don\'t Starve', 'Tựa game Don\'t Starve đã ra mắt bản thử nghiệm cho tựa game mới Don\'t Starve: Together. Trên thực tế, đây là phiên bản đầu tiên Don\'t Starve cho phép lượng người chơi đông đảo của mình trải nghiệm chế độ Multi-player.\r\nTrên thực tế, Don\'t Starve từng được nhiều giải thưởng bình chọn là tựa game indie hay nhất năm 2013, và điều này cũng đã nói lên phần nào sự hấp dẫn của tựa game này.\r\n\r\nDon\'t Starve là tựa game giới thiệu người chơi đến một thế giới khá rộng lớn, nơi họ sẽ được trải nghiệm một cuộc sống \"sinh tồn\" theo đúng nghĩa nhưng cũng không kém phần hài hước.\r\n \r\n\r\nCấu trúc của mọi màn chơi trong game đều xoay quanh việc một nhân vật phải chống chịu lại sự khắc nghiệt của thiên nhiên khi phải sống một mình giữa vùng đất hoang vắng. Nơi người chơi sẽ phải tự động săn bắn, hái quả để tìm lương thực. Ngoài ra, họ cũng có thể chăn nuôi thêm các loại gia súc để lấy lương thực và vật phẩm khác, nhằm chế tạo ra các loại trang bị mới.\r\n\r\nViệc xây dựng công trình, thành quách để trú ngụ là điều rất quan trọng, nơi người chơi sẽ phải ẩn nấp qua đêm. Ngoài ra, một yếu tố quan trọng trong Don\'t Starve chính là giữ cho lửa không bị tắt vào ban đêm. Nếu lửa tắt sau một vài giây, nhân vật sẽ tự bị chết.', 50000, 'dontstave.jpg'),
(7, 'Left 4 Dead 2', 'Trong Left 4 Dead 2, Vale mang đến cho người chơi 4 nhân vật hoàn toàn mới với những món vũ khí và sở trường chiến đấu khác nhau: đạo diễn truyền hình Rochelle, thầy giáo thể dục Coach, anh chàng thợ máy Ellis và Nick-1 kẻ nghiện cờ bạc. Tất cả chiến đấu cùng nhau vì 1 mục tiêu duy nhất: Sống. Có lẽ đây là “biệt đội” lạ đời nhất trong những tựa game trên thị trường hiện nay khi tập hợp đủ thành phần và lứa tuổi. Đến với Left 4 Dead 2, người chơi mới nhận ra nhiều bài học quý giá mà lắm lúc trong cuộc sống hằng ngày bạn vô tình hay cố ý phớt lờ. Đôi lúc, ranh giới giữa sự sống và cái chết là vô cùng mong manh và chỉ 1 phút sơ sẩy là bạn đã phải trả giá bằng cả mạng sống của mình. Rõ ràng, Valve đã truyền tải 1 thông điệp vô cùng mạnh mẽ', 140000, 'l4d2.jpg'),
(8, 'Assassin’s Creed Origins', 'Khi nhắc đến Assassin’s Creed, chắc chắn sẽ có rất nhiều người biết nhận ra ngay, khi đây là một trong những dòng game được rất nhiều người yêu thích. Và với Assassin’s Creed Origins, bạn sẽ có thể tiếp tục dõi theo hành trình của những sát thủ bóng đêm trong cuộc chiến bảo vệ chính nghĩa tại đất nước Ai Cập cổ đại.', 500000, 'ac_origin.jpg'),
(9, 'Dragon Ball FighterZ', 'Dragon Ball FighterZ là tựa game đối kháng trên nền đồ họa 2,5D. Khác với những tựa game trước đây, cơ chế chiến đấu trong Dragon Ball Fighter Z cho phép bạn điều khiển cùng lúc một tổ đội có 3 nhân vật. Những nhân vật này sẽ kết hợp với nhau để tạo thành một đội hình ăn ý và mạnh mẽ nhất.\r\nĐến với Dragon Ball FighterZ, người chơi sẽ được gặp lại những nhân vật vô cùng quen thuộc như Goku, Vegeta, Cell, Frieza, Majin Buu và nhiều hơn nữa. Với người hâm mộ, việc mỗi năm được chào đón một tựa game Dragon Ball mới đã trở thành thói quen khó bỏ. Và trong những năm gần đây, Dragon Ball Fighter Z chính là cái tên sáng giá nhất cho người hâm mộ \"Bi Rồng\".', 1080000, 'dragonballz.jpg'),
(10, 'Elden Ring', 'Elden Ring là bom tấn nhập vai hành động sắp ra mắt được phát triển bởi FromSoftware và do Bandai Namco Entertainment phát hành. Trò chơi là sự hợp tác giữa đạo diễn Hidetaka Miyazaki của Dark Souls và tiểu thuyết gia George RR Martin - “cha đẻ” của Trò chơi vương quyền.', 900000, 'eldenring.jpg'),
(11, 'Far Cry 4', 'Ẩn mình trong dãy Himalaya cao chót vót là Kyrat, một đất nước ngập tràn truyền thống và bạo lực. Bạn là Ajay Ghale. Du hành đến Kyrat để thực hiện ước nguyện sắp chết của mẹ bạn, bạn thấy mình bị cuốn vào cuộc nội chiến nhằm lật đổ chế độ áp bức của nhà độc tài Pagan Min. Khám phá và điều hướng thế giới mở rộng lớn này, nơi nguy hiểm và sự khó lường luôn rình rập mọi ngóc ngách. Ở đây, mọi quyết định đều có giá trị, và mỗi giây là một câu chuyện. Chào mừng đến với Kyrat.\r\nKhám phá thế giới Far Cry đa dạng nhất từng được tạo ra. Với địa hình trải dài từ những khu rừng tươi tốt đến dãy Himalaya phủ đầy tuyết, toàn bộ thế giới đang sống… và chết chóc.\r\n- Từ báo hoa mai, tê giác, đại bàng đen và những con lửng mật hung ác, Kyrat là nơi sinh sống của các loài động vật hoang dã phong phú. Khi bạn bắt tay vào việc săn tìm tài nguyên, hãy biết rằng có thứ gì đó có thể đang săn lùng bạn ...\r\n- Trinh sát lãnh thổ của kẻ thù từ trên cao trong con quay hồi chuyển hoàn toàn mới và sau đó quay trở lại trái đất trong bộ cánh của bạn. Leo lên lưng của một con voi nặng sáu tấn và giải phóng sức mạnh thô sơ của nó lên kẻ thù của bạn.\r\n- Chọn vũ khí phù hợp cho công việc, bất kể công việc đó có thể điên rồ hoặc khó lường đến mức nào. Với kho vũ khí đa dạng, bạn sẽ sẵn sàng cho mọi thứ.', 480000, 'farcry4.jpg'),
(12, 'Minecraft Dungeons', 'Nếu yêu thích series Minecraft: Story Mode với những câu chuyện kể xoay quanh cuộc chiến sinh tồn trong thế giới khối hộp Minecraft thì chắc chắn bạn cũng sẽ dành sự quan tâm đặc biệt cho Minecraft Dungeons. Đây là tựa game phiêu lưu theo phong cách Dungeon crawler - khám phá hầm ngục tăm tối. Game đã nhận được phản hồi tích cực bởi lối chơi thú vị, hấp dẫn trên nền đồ họa và âm nhạc tuyệt vời.\r\nNó được ví như game Diablo “khoác áo” Minecraft. Bạn sẽ chiến đấu với quái vật, loot đồ, trao đổi hàng hóa để lấy công cụ tốt hơn… Bạn có thể chiến đấu một mình hoặc lập đội cùng bạn bè. Đây là trò chơi lý tưởng với những ai muốn trải nghiệm game có chiều sâu trong một thời gian dài. Hệ thống bản đồ thực thi nhiệm vụ được tạo ngẫu nhiên với độ khó tăng dần. Bạn sẽ khó lòng cảm thấy nhàm chán khi trải nghiệm Minecraft Dungeons.', 600000, 'minecraft.jpg'),
(13, 'NARAKA: BLADEPOINT', 'Tại sự kiện game Battle Royale của E3 2021, nhà phát triển 24 Entertainment đã công bố ngày ra mắt chính thức của tựa game Naraka: Bladepoint là vào 12/8 tới đây. Bên cạnh đó, nhà phát triển cũng tiết lộ thêm rằng trước khi ra mắt chính thức thì siêu phẩm \"PUBG kiếm hiệp\" sẽ mở cửa bản thử nghiệm beta thêm một lần nữa vào đầu mùa hè này.\r\nại màn giới thiệu ở sự kiện E3 2021 vừa qua, chúng ta có thể thấy game đã có thêm nhiều cơ chế chiến đấu mới so với lần mở cửa thử nghiệm đầu tiên. Từ cơ chế dùng móc câu để di chuyển tự do lên tường và trần nhà để tạo thế bất lợi cho kẻ thù cho đến sự ra mắt của vũ khí mới là cây thương, và nhân vật mới Yoto Hime. Đi cùng với đó là những chiêu thức vô cùng ảo diệu để sinh tồn và hạ gục đối thủ trong thế giới võ lâm hiểm ác.\r\n\r\nDành cho những bạn nào chưa biết thì Naraka: Bladepoint là một tựa game thuộc thể loại Battle Royale. Tuy nhiên, bạn sẽ không nhảy dù từ máy bay xuống rồi loot súng để bắn nhau mà bạn sẽ loot những món vũ khí như đoản kiếm, katana, cung, nỏ và đồ long đao.\r\n\r\nBên cạnh đó, mỗi một class nhân vật bạn chọn sẽ có một bộ kỹ năng riêng, bao gồm kỹ năng phụ dùng để bổ trợ cho người chơi trong trận đấu như hồi máu, tăng phòng thủ, và chiêu Ulti như hóa hình khổng lồ để lật ngược thế cờ khi giao tranh.', 360000, 'naraka.jpg'),
(14, 'Rust', 'Là một game sinh tồn chỉ có chế độ multiplayer, “Rust” là sản phẩm sẽ quẳng bạn vào một môi trường tự nhiên với một nhiệm vụ duy nhất là làm sao để sống sót được lâu. Người chơi sẽ bắt đầu hành trình đơn độc tại một nơi rừng rú và được trang bị những vật dụng cơ bản như một hòn đá và một cây đuốc để chống chọi với hiểm họa của tự nhiên. Sau này, người chơi có thể nhập hội với những người chơi khác và tha hồ đối mặt tình huống sinh tử thú vị.\r\nCó thể nói, Rust là một lựa chọn hàng đầu cho các game thủ yêu thích sự hoang dã. Bạn có thể đi một mình khám phá cả bản đồ rộng lớn, nếu cô đơn thì hãy kết bạn với những người chơi khác nhưng cẩn thận kẻo bị đập đá vào đầu. Game sẽ cung cấp cho bạn một kho vũ khí đồ sộ từ những món cơ bản, đơn giản đến cả những căn cứ khổng lồ. Xung quanh bạn không thiếu động vật hoang dã nhắm vào, nhưng sống sót khỏi lũ thú hoang là chuyện nhỏ. Đây là game sinh tồn chú trọng vào mục PVP, thậm chí gần đây game bỏ luôn cả hệ thống XP và cấp bậc để bảo vệ tính công bằng trong game, do vậy kẻ thù chính là đồng loại của bạn chứ không hải dã thú ngoài kia.', 480000, 'rust.jpg'),
(15, 'Mega Man 11', 'Mega Man đã trở lại! Mục mới nhất trong loạt phim mang tính biểu tượng này pha trộn giữa hành động nền tảng 2D cổ điển, đầy thử thách với giao diện mới mẻ. Phong cách hình ảnh mới tuyệt đẹp làm mới màu sắc mang tính biểu tượng của loạt trò chơi, kết hợp môi trường vẽ tay với các mô hình nhân vật 3D chi tiết.\r\n\r\nĐể cứu lấy ngày hôm nay, Blue Bomber phải chiến đấu với các Robot Master và lấy vũ khí mạnh mẽ của họ cho chính mình, giờ đây chúng sẽ thay đổi diện mạo của anh hùng với các cấp độ chi tiết mới. Hệ thống Double Gear cải tiến mới cho phép bạn tăng tốc độ và sức mạnh của Mega Man để tạo ra một bước ngoặt mới về lối chơi thỏa mãn mà bộ truyện nổi tiếng đã mang tới.\r\n\r\nMột loạt các chế độ khó khiến đây là cơ hội hoàn hảo để trải nghiệm Mega Man lần đầu tiên!\r\n\r\nMega Man 11 cũng có nhiều chế độ bổ sung bao gồm thử nghiệm thời gian, nhiệm vụ, bảng xếp hạng toàn cầu, phòng trưng bày nghệ thuật ý tưởng và hơn thế nữa!', 145000, 'megaman.jpg'),
(16, '7 Days To Die', '7 Days to Die vẫn chỉ là một dự án chưa chính thức bởi nó đang cần một số vốn từ Kickstarter để bắt đầu. The Fun Pimps Entertainment chỉ là một hãng game nhỏ mới được thành lập vào năm 2013 nên họ chưa thể có nhiều kinh phí.\r\nMột cốt truyện không có gì đặc sắc, nhưng 7 Days to Die sẽ có những yếu tố nhất định để tạo nên nét riêng biệt cho gameplay của mình, đó là sự kết hợp của 4 thể loại: Nhập vai, FPS, sinh tồn kinh dị và thủ thành - tất cả diễn ra trên một thế giới mở rộng lớn.\r\n\r\nTrong thế giới của 7 Days to Die, người chơi sẽ có cơ hội khám phá rất nhiều vùng đất, từ núi tuyết, sa mạc đến vùng phóng xạ, mỗi nơi lại có những tài nguyên để thu thập, những ngôi nhà để khám phá và nhiều điều để tìm hiểu. Để sinh tồn, người chơi cần tìm kiếm tài nguyên để tạo ra dụng cụ cần thiết, săn bắn để tạo ra đồ ăn, biết cách làm sạch nước để uống, xây nhà để tự bảo vệ mình...\r\n\r\nĐối mặt với hàng tá kẻ thù bằng súng hoặc những vũ khí tự tạo, Zombie ở đây không “vô não” mà có rất nhiều khả năng, thậm chí biết làm việc theo nhóm. Về yếu tố RPG, người chơi có thể tích lũy điểm kinh nghiệm để nâng cấp kĩ năng của mình trong chiến đấu, thậm chí trong những sinh hoạt thường ngày.', 220000, '7day.jpg'),
(17, 'Pacify', 'Pacify là tựa game phiêu lưu hành động đậm chất kinh dị, đưa bạn vào hành trình khám phá ngôi nhà ma ám, nơi quỷ dữ đang trú ngụ.\r\nPacify mô phỏng chân thực nhà xác lạnh lẽo, là cơ hội cuối cùng để người chơi trò chuyện với những người thân yêu của mình. Nơi ấy có ánh sáng, tiếng cười, cô gái bí ẩn và những người mất tích… Bạn đã nghe những điều tương tự như vậy về nơi này. Hãy lập 1 đội và cùng nhau khám phá ngôi nhà ma trong game Pacify.\r\nBạn vừa gia nhập PAH Inc. - tên viết tắt của Paranatural Activity Helpers Incorporated với mức lương hậu hĩnh. Họ nói đây là công việc an toàn, bạn sẽ không gặp nguy hiểm và luôn bận rộn với các hoạt động tích cực. Và công việc đầu tiên của bạn là ở… ngôi nhà ma ám cũ kỹ. Có 1 “cò” đất muốn rao bán ngôi nhà, nhưng vì cả thị trấn lan truyền tin đồn về ngôi nhà ma này nên anh ta chưa thể bán được. Anh ta cần bạn đến kiểm tra và xác nhận ngôi nhà an toàn. Game thủ có thể tham gia nhiệm vụ 1 mình hoặc cùng 3 người nữa. Kiểm tra địa điểm và nếu có bất cứ điều gì bất thường xảy ra, hãy ghi lại bằng chứng cho PAH Inc.\r\n\r\nBối cảnh là ngôi nhà cổ có tuổi đời hàng trăm năm. Chủ sở hữu của nó từng là chủ nhà tang lễ. Họ tổ chức các dịch vụ tang lễ thông thường như khâm liệm, hỏa táng và chôn cất người chết. Tin đồn khắp thị trấn cho biết họ cung cấp 1 dịch vụ rất đặc biệt - giúp người thân có thể trò chuyện với người đã chết 1 lần cuối cùng.\r\n\r\nMột số người đã trả tiền cho dịch vụ này. Sau 1 loạt nghi lễ, họ đã trò chuyện được với người chết. Nhưng dường như mọi thứ không suôn sẻ. Vì lý do nào đó, 1 người dân trong thị trấn cùng chủ sở hữu ngôi nhà đã biến mất và không bao giờ thấy họ quay trở lại. Trong suốt 1 thế kỷ qua, đã có vài người đến điều tra vụ việc và họ cũng không quay trở lại. Những đứa trẻ tò mò trong thị trấn đi mon men quanh ngôi nhà và chúng đã nghe thấy tiếng cười, thậm chí hình ảnh 1 cô bé bên ô cửa sổ. Không ai biết sự thật là gì…', 90000, 'pacify.jpg'),
(18, 'Forza Horizon 4', 'Thật khó để một dòng game đã hoàn hảo trở nên hoàn hảo hơn nữa sau mỗi phiên bản khi bộ “khung sườn” đã được dày công xây dựng và quá khó để kiến tạo cho những thay đổi mang tính cách mạng. Ấy thế mà Forza lại là một ngoại lệ ngạc nhiên khá thú vị khi trong vài năm trở lại đây, dòng game này mỗi năm đều “đẻ” ra một phiên bản mới được xoay vòng theo hai nhánh: bán mô phỏng với Forza Motorsport và đua đường phố thế giới mở với Forza Horizon. Qua mỗi phiên bản của từng dòng game, người ta lại thấy được sự đi lên ổn định đáng kinh ngạc. Thật không quá khi nói rằng Forza hiện tại đang là ông vua của thể loại đua xe, từ đường phố vào tới trường đua.\r\n\r\nNăm 2016, chúng ta chứng kiến một Forza Horizon 3 gần như “chạm nóc” của chuẩn mực chất lượng khi bất kì những ai dù khó tính nhất cũng chẳng thể tìm ra một chi tiết nhỏ để chê về tựa game này. Thế nên tại E3 2018, Forza Horizon 4 được trình làng, một lần nữa giới mộ điệu đam mê tốc độ lại đứng ngồi không yên khi màn trình diễn của tựa game này chỉ có thể gói gọn trong hai từ: tuyệt vời! Lần này, rời xa nước Úc, chúng ta sẽ đến với những cung đường của Vương Quốc Anh hứa hẹn với những thay đổi đáng kể.\r\n\r\nSau khi tung hoành ở “xứ sở chuột túi” trong Forza Horizon 3, Playground Games tiếp tục đưa người chơi chinh phục một vùng đất khác, lần này là Anh Quốc – vùng đất được mệnh danh là “Xứ sở sương mù”.', 790000, 'forza.jpg'),
(19, 'Atomic Heart', 'Chào mừng bạn đến với một thế giới không tưởng của những điều kỳ diệu và hoàn hảo, trong đó con người sống hòa thuận với những người máy trung thành và nhiệt thành của họ.\r\n\r\nVâng, đó là cách nó được sử dụng để được. Với sự ra mắt của hệ thống điều khiển robot mới nhất chỉ còn vài ngày nữa, chỉ một tai nạn bi thảm hoặc một âm mưu toàn cầu mới có thể phá vỡ nó…\r\n\r\nQuá trình phát triển không ngừng của công nghệ cùng với các thí nghiệm bí mật đã làm nảy sinh những sinh vật đột biến, những cỗ máy đáng sợ và những người máy siêu mạnh—tất cả đột nhiên nổi dậy chống lại người tạo ra chúng. Chỉ bạn mới có thể ngăn chặn chúng và tìm ra điều gì ẩn sau thế giới lý tưởng hóa.\r\n\r\nSử dụng các khả năng chiến đấu được cấp bởi chiếc găng tay sức mạnh thử nghiệm của bạn, kho kiếm và vũ khí tối tân của bạn, chiến đấu cho cuộc sống của bạn trong các cuộc chạm trán bùng nổ và điên cuồng. Điều chỉnh phong cách chiến đấu của bạn cho từng đối thủ độc đáo. Kết hợp các kỹ năng và tài nguyên của bạn, sử dụng môi trường và nâng cấp thiết bị của bạn để vượt qua các thử thách và chiến đấu vì điều tốt đẹp.\r\n\r\nMột thế giới không tưởng, vừa điên rồ vừa siêu phàm\r\nNội tạng, ngoạn mục và chiến đấu không khoan nhượng\r\nLàm nổ tung những cỗ máy khổng lồ và dị nhân bằng nhiều kỹ năng và vũ khí tối tân của bạn\r\nNâng cấp kho vũ khí và thiết bị của bạn', 750000, 'atomic.jpg'),
(20, 'Scrap Mechanic', 'Công cụ và bước vào thiên đường sáng tạo của Scrap Mechanic! Chế tạo những cỗ máy tuyệt vời, tham gia cuộc phiêu lưu cùng bạn bè và bảo vệ chống lại những Farmerbots xấu xa trong hộp cát sinh tồn nhiều người chơi đầy trí tưởng tượng này. Với các công cụ sáng tạo mạnh mẽ của Scrap Mechanic, bạn có thể thiết kế các cuộc phiêu lưu của riêng mình!\r\nHọ nói: \'Hãy trở thành một thợ cơ khí robot\'. Họ nói: \'Kiếm tiền dễ dàng\'. Chúng tôi khá chắc chắn rằng mô tả công việc không đề cập đến vụ rơi khi hạ cánh xuống một hành tinh xa xôi, với hàng ngàn robot công nhân điên cuồng phải đổ máu! Bạn bị mắc kẹt trên một hành tinh nông nghiệp xa xôi nơi các Farmbots làm việc trên cánh đồng đã biến mất. Với dây đai công cụ của bạn được thắt chặt, chỉ có một cách để tồn tại: sử dụng tư duy nhanh nhạy, óc sáng tạo và sở trường biến môi trường xung quanh thành lợi thế của bạn!', 200000, 'scrap.jpg'),
(97, 'Sword Art Online Re', 'Bạn sẽ nhập vai vào nhân vật Kirito, một anh hùng của loạt phim hoạt hình Sword Art Online nổi tiếng và khám phá một thế giới giả tưởng rộng lớn cùng với đó ở bên cạnh nhân vật sẽ có những người bạn đồng hành vô cùng hấp dẫn!\r\n\r\nTừ căn cứ của Ark Sophia, một thị trấn nằm trên tầng 76, hãy cố gắng lên đến tầng 100 của Aincrad và khám phá Hollow Area!\r\n\r\nChiến lược trong trò chơi sẽ là hạ gục những kẻ thù khó nhằn để tồn tại trong thế giới khắc nghiệt này. Trò chuyện với những người bạn đồng hành của bạn trong thời gian thực cùng với đó là tham gia vào các trận chiến chiến lược, đầy tính hành động!', 185000, 'sword.jpg'),
(102, 'The Office Quest', 'Office Quest là một trò chơi phiêu lưu trỏ chuột và nhấp thông thường dành cho những người không muốn ở lại văn phòng lâu thêm chút nào nữa, tràn đầy những hình ảnh hài hước , thử thách, câu đố và phần là những chiếc áo khoác mịn màng mà ai cũng hằng mong muốn sở hữu vì tại sao không. Bạn có một công việc nhàm chán, nhấp vào cùng một phím trên cùng một bàn phím ở cùng một bàn làm việc mỗi ngày trong tuần. Rồi một ngày, một điều gì đó kỳ lạ và kỳ diệu xảy ra, và bạn thực sự, thực sự cần khám phá điều gì đang xảy ra - và vì điều đó, bạn cần bỏ qua bài viết của mình và rời khỏi vực thẳm màu xám mà họ gọi là văn phòng…', 85000, 'theoffice.jpg'),
(104, 'Forza Horizon 5', 'Forza Horizon 5 là phiên bản mới nhất trong series game đua xe Forza Horizon đình đám. Đua ô tô cực vui và không giới hạn trong thế giới mở của Forza Horizon 5 PC để khám phá vô vàn điều mới lạ!\r\n\r\nGame Forza Horizon 5 đưa bạn vào chuyến phiêu lưu bất tận để chạm tới… đường chân trời. Khám phá thế giới mở sống động và cảnh quan tuyệt đẹp tại đất nước Mexico, phô diễn kỹ năng lái xe và phản xạ tuyệt vời cùng hàng trăm chiếc xe đua nổi tiếng thế giới và hơn thế…', 1200000, 'forza5.jpg'),
(105, 'Nine Parchments', 'Nine Parchments là một trò chơi vô cùng bùng nổ mang tính hợp tác với những màn phối hợp ma thuật từ Frozenbyte, những người sáng tạo ra loạt phim Trine!\r\n\r\nCác pháp sư tập sự của Runaway nắm bắt cơ hội để hoàn thành cuốn sách thần chú của họ bằng cách truy tìm Nine Parchments bị mất.\r\n\r\nVì các pháp sư sẽ nhanh chóng có được những phép thuật mới mạnh mẽ mà không cần học các biện pháp an toàn thích hợp, nên sự tiến bộ vội vàng của họ dẫn đến vô số tai nạn chết người ...\r\n\r\nNine Parchments kết hợp hành động bắn súng thần chú trong thời gian thực với các yếu tố RPG - nâng cấp nhân vật của bạn và thu thập chiến lợi phẩm ma thuật, lấp đầy tủ quần áo của bạn với vô số mũ phù thủy và gậy mạnh mẽ.', 188000, 'nine.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `game_genre`
--

CREATE TABLE `game_genre` (
  `gameid` int NOT NULL,
  `genreid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game_genre`
--

INSERT INTO `game_genre` (`gameid`, `genreid`) VALUES
(2, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(13, 1),
(15, 1),
(19, 1),
(97, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(8, 2),
(10, 2),
(12, 2),
(15, 2),
(20, 2),
(102, 2),
(105, 2),
(9, 3),
(97, 3),
(4, 4),
(7, 4),
(11, 4),
(14, 4),
(16, 4),
(19, 4),
(20, 4),
(3, 5),
(6, 5),
(105, 5),
(18, 6),
(104, 6),
(4, 7),
(8, 7),
(10, 7),
(11, 7),
(104, 7),
(1, 8),
(4, 8),
(6, 8),
(14, 8),
(16, 8),
(17, 8),
(20, 8),
(1, 9),
(7, 9),
(16, 9),
(17, 9),
(102, 9),
(1, 10),
(5, 10),
(8, 10),
(12, 10),
(13, 10),
(15, 10),
(19, 10),
(102, 10),
(105, 10),
(18, 11),
(104, 11);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Hành Động'),
(2, 'Phiêu Lưu'),
(3, 'Đối Kháng'),
(4, 'Bắn Súng'),
(5, 'Chiến Thuật'),
(6, 'Thể Thao'),
(7, 'Thế Giới Mở'),
(8, 'Sinh Tồn'),
(9, 'Kinh Dị'),
(10, 'Nhập Vai'),
(11, 'Đua Xe');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sdt` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `fullname`, `sdt`) VALUES
(1, 'duy', '1', 'admin', 'Huỳnh Khánh Duy', '083727828'),
(2, 'test', '1', 'admin', 'Nguyễn Văn Lâm', '0918288238'),
(3, 'binh', '1', 'user', 'Đỗ Thị Bình', '012834828'),
(4, 'hoang', '123456', 'user', 'Nguyễn Văn Hoàng', '0394939393');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`,`id_user`,`code_cart`),
  ADD UNIQUE KEY `code_cart` (`code_cart`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`code_cart`,`id_game`),
  ADD KEY `cart_detail_ibfk_2` (`id_game`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD PRIMARY KEY (`gameid`,`genreid`),
  ADD KEY `game_genre_ibfk_2` (`genreid`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `sdt` (`sdt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `cart_detail_ibfk_2` FOREIGN KEY (`id_game`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_detail_ibfk_3` FOREIGN KEY (`code_cart`) REFERENCES `cart` (`code_cart`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD CONSTRAINT `game_genre_ibfk_1` FOREIGN KEY (`gameid`) REFERENCES `game` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_genre_ibfk_2` FOREIGN KEY (`genreid`) REFERENCES `genre` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
