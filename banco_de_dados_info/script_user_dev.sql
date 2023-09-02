CREATE USER 'adm_LivroReceitas'@'localhost' IDENTIFIED WITH mysql_native_password BY 'livro123'; 
grant select, insert, update, delete on eajuda.* to 'adm_LivroReceitas'@'localhost';