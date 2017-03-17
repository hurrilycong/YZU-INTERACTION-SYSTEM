/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  zhangxile
 * Created: 2017-2-27
 */

# Host 127.0.0.1
# Database:teacher_student

# 2017年2月26日
# 开始编写

DROP TABLE IF EXISTS `admin_information`;

CREATE TABLE `admin_information`(
    'user_number' int(12) NOT NULL COMMENT '用户ID',
    ''
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;