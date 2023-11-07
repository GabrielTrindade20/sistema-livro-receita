CREATE USER 'adm_LivroReceitas'@'localhost' IDENTIFIED WITH mysql_native_password BY 'livro123'; 
grant select, insert, update, delete on livro_receita_dev.* to 'adm_LivroReceitas'@'localhost';

-- Em caso de erro, usar:
-- CREATE USER 'adm_LivroReceitas'@'localhost' IDENTIFIED BY 'livro123'; 
-- grant select, insert, update, delete on livro_receita_dev.* to 'adm_LivroReceitas'@'localhost';