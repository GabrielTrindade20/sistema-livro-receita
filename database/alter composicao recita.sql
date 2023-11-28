select * from receita;

delete from receita where nome_receita = 'texte';

ALTER TABLE composicao
DROP FOREIGN KEY composicao_ibfk_1;

ALTER TABLE composicao
ADD CONSTRAINT composicao_ibfk_1
FOREIGN KEY (nome_receita)
REFERENCES receita (nome_receita)
ON DELETE CASCADE;
