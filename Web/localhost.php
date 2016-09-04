<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 0.2b
 */

//
// Database `courier`
//

// `courier`.`clientinfo`
$clientinfo = array(
  array('identi_num' => '1','name' => 'Tom','phone_num' => '01077352738','address' => '경기도 용인시 기흥구 서천동 313-3','courier_count' => '4'),
  array('identi_num' => '2','name' => 'David','phone_num' => '01073853542','address' => '경기도 용인시 기흥구 서천동 322-11','courier_count' => '1'),
  array('identi_num' => '3','name' => 'Cathy','phone_num' => '01037541324','address' => '경기도 성남시 기흥구 서천동 804','courier_count' => '0'),
  array('identi_num' => '4','name' => 'Jonathan','phone_num' => '01016957565','address' => '경기도 성남시 분당구 야탑동 경남 아너스빌아파트','courier_count' => '0'),
  array('identi_num' => '5','name' => 'Nancy','phone_num' => '01078334896','address' => '경기도 수원시 영통구 영통동 1019-13','courier_count' => '0'),
  array('identi_num' => '6','name' => '김소희','phone_num' => '01097853565','address' => '경기도 용인시 기흥구 서천동 322-17','courier_count' => '0'),
  array('identi_num' => '7','name' => '강경일','phone_num' => '01053367887','address' => '경기도 수원시 영통구 영통동 1019-13','courier_count' => '0'),
  array('identi_num' => '8','name' => '박형준','phone_num' => '01079335465','address' => '서울특별시 종로구 인사동 190-2','courier_count' => '0'),
  array('identi_num' => '9','name' => '최은진','phone_num' => '01067721586','address' => '서울특별시강남구대치2동998','courier_count' => '0'),
  array('identi_num' => '10','name' => '조경민','phone_num' => '01055786345','address' => '경기도 성남시 중원구 중앙동 1152','courier_count' => '0')
);

// `courier`.`courierinfo`
$courierinfo = array(
  array('identi_num' => '101','profit' => '100','size' => '100','type' => '의류','receiver_identi' => '1','delivery_identi' => '51','isdelivered' => '0','sender_name' => '김민수','date' => '2014/05/28','isevaluate' => '1'),
  array('identi_num' => '200','profit' => '200','size' => '200','type' => '전자기기','receiver_identi' => '1','delivery_identi' => '51','isdelivered' => '1','sender_name' => '김수민','date' => '2014/05/29','isevaluate' => '0'),
  array('identi_num' => '300','profit' => '300','size' => '300','type' => '도서','receiver_identi' => '1','delivery_identi' => '53','isdelivered' => '2','sender_name' => '고세원','date' => '2014/05/27','isevaluate' => '1'),
  array('identi_num' => '400','profit' => '400','size' => '400','type' => '가구','receiver_identi' => '1','delivery_identi' => '54','isdelivered' => '0','sender_name' => '김준호','date' => '2014/06/02','isevaluate' => '0'),
  array('identi_num' => '500','profit' => '500','size' => '500','type' => '도서','receiver_identi' => '2','delivery_identi' => '51','isdelivered' => '0','sender_name' => '전영우','date' => '2014/05/27','isevaluate' => '0'),
  array('identi_num' => '600','profit' => '600','size' => '600','type' => '도서','receiver_identi' => '3','delivery_identi' => '53','isdelivered' => '0','sender_name' => 'Tiffany','date' => '2014/06/08','isevaluate' => '0'),
  array('identi_num' => '700','profit' => '700','size' => '700','type' => '가구','receiver_identi' => '5','delivery_identi' => '54','isdelivered' => '0','sender_name' => 'Ryan','date' => '2014/06/06','isevaluate' => '0'),
  array('identi_num' => '800','profit' => '800','size' => '800','type' => '전자기기','receiver_identi' => '5','delivery_identi' => '52','isdelivered' => '1','sender_name' => 'Bryan','date' => '2014/06/02','isevaluate' => '0'),
  array('identi_num' => '900','profit' => '900','size' => '900','type' => '가구','receiver_identi' => '0','delivery_identi' => '55','isdelivered' => '1','sender_name' => 'Rebecca','date' => '2014/05/30','isevaluate' => '0'),
  array('identi_num' => '1000','profit' => '1000','size' => '1000','type' => '도서','receiver_identi' => '0','delivery_identi' => '53','isdelivered' => '0','sender_name' => '서민석','date' => '2014/05/28','isevaluate' => '0'),
  array('identi_num' => '1100','profit' => '1100','size' => '1100','type' => '도서','receiver_identi' => '0','delivery_identi' => '52','isdelivered' => '1','sender_name' => '최록산','date' => '2014/05/27','isevaluate' => '0'),
  array('identi_num' => '1200','profit' => '1200','size' => '1200','type' => '운동화','receiver_identi' => '6','delivery_identi' => '51','isdelivered' => '2','sender_name' => '곽원석','date' => '2014/06/16','isevaluate' => '1'),
  array('identi_num' => '1300','profit' => '1300','size' => '1300','type' => '미용도구','receiver_identi' => '7','delivery_identi' => '51','isdelivered' => '2','sender_name' => '김유니','date' => '2014/06/15','isevaluate' => '0'),
  array('identi_num' => '1400','profit' => '1400','size' => '1400','type' => '도서','receiver_identi' => '8','delivery_identi' => '51','isdelivered' => '2','sender_name' => '신푸른','date' => '2014/06/14','isevaluate' => '0'),
  array('identi_num' => '1500','profit' => '1500','size' => '1500','type' => '사무용품','receiver_identi' => '9','delivery_identi' => '51','isdelivered' => '2','sender_name' => '김소언','date' => '2014/06/12','isevaluate' => '0')
);

// `courier`.`deliveryinfo`
$deliveryinfo = array(
  array('identi_num' => '51','name' => 'Joe','phone_num' => '01042318864','income' => '5000'),
  array('identi_num' => '52','name' => 'Jack','phone_num' => '01096454358','income' => '10000'),
  array('identi_num' => '53','name' => 'Lebecca','phone_num' => '01012315344','income' => '7000'),
  array('identi_num' => '54','name' => 'Robinson','phone_num' => '01043888353','income' => '8000'),
  array('identi_num' => '55','name' => 'Ryan','phone_num' => '01043833363','income' => '15000'),
  array('identi_num' => '56','name' => 'Tiffany','phone_num' => '01032435665','income' => '100'),
  array('identi_num' => '57','name' => '최진성','phone_num' => '01015425534','income' => '5000'),
  array('identi_num' => '58','name' => '김용완','phone_num' => '01088653285','income' => '6000'),
  array('identi_num' => '59','name' => '박재호','phone_num' => '01099783588','income' => '7000')
);

// `courier`.`evaluation`
$evaluation = array(
  array('evaluation_info' => 'thanks','courier_identi' => '101'),
  array('evaluation_info' => '감사합니다','courier_identi' => '300'),
  array('evaluation_info' => '감사영','courier_identi' => '1200')
);

// `courier`.`logininfo`
$logininfo = array(
  array('id' => 'rooot','password' => 'admin','identi_num' => '1'),
  array('id' => 'abc','password' => '123','identi_num' => '51'),
  array('id' => 'qwer','password' => '123','identi_num' => '3'),
  array('id' => 'fani','password' => 'haha','identi_num' => '2'),
  array('id' => 'junhoya','password' => 'jhjh','identi_num' => '4'),
  array('id' => 'qaz','password' => '442','identi_num' => '5'),
  array('id' => 'asbf','password' => '4ww3','identi_num' => '52'),
  array('id' => '57te','password' => 'asd3','identi_num' => '53'),
  array('id' => 'd244e','password' => '536','identi_num' => '54'),
  array('id' => 'dani','password' => 'h89','identi_num' => '55'),
  array('id' => 'jun','password' => '123','identi_num' => '56'),
  array('id' => '111','password' => '222','identi_num' => '6'),
  array('id' => 'w453','password' => '1534','identi_num' => '57'),
  array('id' => 'g4hh','password' => '5654','identi_num' => '58'),
  array('id' => 'fg24','password' => '9978','identi_num' => '59'),
  array('id' => 'qdd3','password' => '1443','identi_num' => '7'),
  array('id' => 'zr23','password' => '4465','identi_num' => '8'),
  array('id' => 'ffd2','password' => '7887','identi_num' => '9'),
  array('id' => 'qwe22','password' => '2232','identi_num' => '10')
);

// `courier`.`nonmemberinfo`
$nonmemberinfo = array(
  array('name' => '박민수','phone' => '01023443565','address' => '서울특별시 강동구 명일1동 327-6','courier_num' => '900'),
  array('name' => '서원준','phone' => '01025603665','address' => '서울특별시 마포구 아현동 677','courier_num' => '1000'),
  array('name' => '이원준','phone' => '01018864899','address' => '서울특별시 종로구 삼청동 102','courier_num' => '1100')
);
//
// Database `test`
//
