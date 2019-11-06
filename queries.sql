USE yeticave;
/* Заполнение таблицы "КАТЕГОРИИ" */
/* Доски и лыжи (boards), Крепления (attachment), Ботинки (boots), Одежда (clothing), Инструменты (tools), Разное (other) */
INSERT INTO categories SET name = 'Доски и лыжи', char_code = 'boards';
INSERT INTO categories SET name = 'Крепления', char_code = 'attachment';
INSERT INTO categories SET name = 'Ботинки', char_code = 'boots';
INSERT INTO categories SET name = 'Одежда', char_code = 'clothing';
INSERT INTO categories SET name = 'Инструменты', char_code = 'tools';
INSERT INTO categories SET name = 'Разное', char_code = 'other';
    
/* Заполнение таблицы "ПОЛЬЗОВАТЕЛИ" */
INSERT INTO users 
    SET dt_reg = "2019-10-25 15:20:00", 
        email = 'juconstant@yandex.ru', 
        name = 'Юлия', 
        pwd = 'Qwe12345', 
        contact = '+79003331122';

INSERT INTO users 
    SET dt_reg = "2019-10-25 15:45:00", 
        email = 'myjusttest@mail.ru', 
        name = 'Julia', 
        pwd = '123qweT', 
        contact = '+79001112233';

INSERT INTO users 
    SET dt_reg = "2019-10-25 16:37:00",
        email = 'myjusttest@yandex.ru', 
        name = 'Yuliya', 
        pwd = 'kbhd0987F', 
        contact = '+79001110033';
        
/* Заполнение таблицы "ЛОТЫ" */
INSERT INTO lots 
    SET dt_create = "2019-10-28 10:03:47", 
        name = '2014 Rossignol District Snowboard',
        description = 'Сноуборд 2014 Rossignol District',
        image_url = 'img/lot-1.jpg',
        start_price = 10999,
        bid_step = 100,
        dt_exp = "2019-11-05",
        category_id = 1,
        user_id = 1,
        winner_id = 3;

INSERT INTO lots 
    SET dt_create = "2019-11-01 13:38:02", 
        name = 'DC Ply Mens 2016/2017 Snowboard',
        description = 'Сноуборд DC Ply Mens 2016/2017',
        image_url = 'img/lot-2.jpg',
        start_price = 159999,
        bid_step = 1000,
        dt_exp = "2019-12-30",
        category_id = 1,
        user_id = 2;
        
INSERT INTO lots 
    SET dt_create = "2019-10-29 18:17:16", 
        name = 'Крепления Union Contact Pro 2015 года размер L/XL',
        description = 'Крепления Union Contact Pro',
        image_url = 'img/lot-3.jpg',
        start_price = 8000,
        bid_step = 100,
        dt_exp = "2019-11-04",
        category_id = 2,
        user_id = 2,
        winner_id = 1;
        
INSERT INTO lots 
    SET dt_create = "2019-11-03 10:03:47", 
        name = 'Ботинки для сноуборда DC Mutiny Charocal',
        description = 'Ботинки для сноуборда',
        image_url = 'img/lot-4.jpg',
        start_price = 10999,
        bid_step = 200,
        dt_exp = "2019-11-15",
        category_id = 3,
        user_id = 3;
        
INSERT INTO lots 
    SET dt_create = "2019-10-30 16:28:30", 
        name = 'Куртка для сноуборда DC Mutiny Charocal',
        description = 'Куртка для сноуборда',
        image_url = 'img/lot-5.jpg',
        start_price = 7500,
        bid_step = 100,
        dt_exp = "2019-11-07",
        category_id = 4,
        user_id = 3;
        
INSERT INTO lots 
    SET dt_create = "2019-11-04 10:03:47", 
        name = 'Маска Oakley Canopy',
        description = 'Маска',
        image_url = 'img/lot-6.jpg',
        start_price = 5400,
        bid_step = 50,
        dt_exp = "2019-11-10",
        category_id = 6,
        user_id = 3;
        
/* Заполнение таблицы "СТАВКИ" */
INSERT INTO bids 
    SET dt_create = "2019-11-05 09:18:52",
        bid_sum = 5400,
        user_id = 1,
        lot_id = 6;

INSERT INTO bids 
    SET dt_create = "2019-11-05 16:01:10",
        bid_sum = 5450,
        user_id = 2,
        lot_id = 6;
        
INSERT INTO bids 
    SET dt_create = "2019-11-05 15:59:03",
        bid_sum = 7500,
        user_id = 2,
        lot_id = 5;
        
/* Ниже этом файле напишите SQL-код всех запросов на выборку данных, каждый с новой строчки.
Каждый запрос предваряйте комментарием с названием действия, для которого он предназначен. */

/* получить все категории;*/
SELECT * FROM categories;

/* получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену?, название категории; */
SELECT l.name, start_price, image_url, c.name FROM lots l 
	JOIN categories c ON (c.id = l.category_id) WHERE dt_exp > NOW() ORDER BY l.dt_create;

/* показать лот по его id. Получите также название категории, к которой принадлежит лот; */
SELECT lots.*, c.name FROM lots JOIN categories c ON (c.id = category_id) WHERE lots.id = 4;

/* обновить название лота по его идентификатору; */
UPDATE lots SET name = 'DC Ply Mens 2016/2017 Snowboard ALMOST NEW' WHERE id = 2;

/* получить список ставок для лота по его идентификатору с сортировкой по дате. */
SELECT * FROM bids WHERE lot_id = 6 ORDER BY dt_create;