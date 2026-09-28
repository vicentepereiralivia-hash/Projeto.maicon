<?php
// Inicia o bloco de codigo PHP.

// Cria a classe Usuario, que representa a model de usuario no MVC.
class aluno
{
    // Declara uma propriedade privada para guardar a conexao com o banco.
    private $con;

    // Cria o metodo construtor, executado automaticamente ao criar um objeto Usuario.
    public function __construct($con)
    {
        // Guarda a conexao recebida dentro da propriedade da classe.
        $this->con = $con;
    }

    // Cria o metodo responsavel por listar todos os usuarios cadastrados.
    public function listar()
    {
        // Monta o comando SQL que busca os alunos e o tipo de curso.
        $sql = "
            SELECT
   
               aluno.id,
               aluno.nome,
               aluno.email,
               curso.nome as curso
            FROM aluno 
            LEFT JOIN curso 
               ON curso.id = aluno.idcurso
            ORDER BY aluno.id ASC;
        ";

        // Executa o comando SQL no banco de dados.
        $resultado = $this->con->query($sql);

        // Cria um array vazio para armazenar os alunos encontrados.
        $alunos = [];

        // Verifica se a consulta falhou.
        if (!$resultado) {
            // Retorna o array vazio caso aconteca algum erro na consulta.
            return $alunos;
        }

        // Percorre cada linha retornada pelo banco de dados.
        while ($linha = $resultado->fetch_assoc()) {
            // Adiciona a linha atual dentro do array de aluno.
            $alunos[] = $linha;
        }

        // Retorna o array completo com todos os aluno encontrados.
        return $alunos;
    }
}
?>
