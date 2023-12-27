Semana 3 

API do controlador de Usuários

GET /api/user

    Descrição: Recupera todos os usuários.
    Endpoint: /api/user
    Parâmetros: Nenhum
    Resposta: Array JSON contendo detalhes dos usuários.

GET /api/user/{id}

    Descrição: Recupera um usuário específico pelo ID.
    Endpoint: /api/user/{id}
    Parâmetros:
        {id} (inteiro): ID do usuário a ser recuperado.
    Resposta: Objeto JSON com detalhes do usuário, se encontrado; caso contrário, uma mensagem de erro com código de status 404.

POST /api/user

    Descrição: Cria um novo usuário.
    Endpoint: /api/user
    Parâmetros:
        nome (string): Nome do usuário.
        email (string): Endereço de e-mail do usuário.
        senha (string): Senha do usuário.
    Resposta: Mensagem de sucesso e detalhes do usuário em formato JSON se a criação for bem-sucedida; caso contrário, uma mensagem de erro com o código de status apropriado.

PUT /api/user

    Descrição: Atualiza um usuário existente.
    Endpoint: /api/user
    Parâmetros:
        id (inteiro): ID do usuário a ser atualizado.
        nome (string): Novo nome do usuário.
        email (string): Novo endereço de e-mail do usuário.
        senha (string): Nova senha do usuário.
    Resposta: Mensagem de sucesso e detalhes atualizados do usuário em formato JSON se a atualização for bem-sucedida; caso contrário, uma mensagem de erro com o código de status apropriado.

DELETE /api/user

    Descrição: Remove um usuário.
    Endpoint: /api/user
    Parâmetros:
        id (inteiro): ID do usuário a ser removido.
    Resposta: Mensagem de sucesso se o usuário for removido com sucesso; caso contrário, uma mensagem de erro com o código de status apropriado.

POST /api/user/filter

    Descrição: Filtra usuários com base em critérios específicos.
    Endpoint: /api/user/filter
    Parâmetros: Campos para filtrar (por exemplo, nome, email, senha).
    Resposta: Array JSON contendo detalhes dos usuários filtrados.


API do Controlador de Postagens

GET /api/postagem

    Descrição: Recupera todas as postagens.
    Endpoint: /api/postagem
    Parâmetros: Nenhum
    Resposta: Array JSON contendo detalhes das postagens.

GET /api/postagem/{id}

    Descrição: Recupera uma postagem específica pelo ID.
    Endpoint: /api/postagem/{id}
    Parâmetros:
        {id} (inteiro): ID da postagem a ser recuperada.
    Resposta: Objeto JSON com detalhes da postagem se encontrada; caso contrário, uma mensagem de erro com código de status 404.

POST /api/postagem

    Descrição: Cria uma nova postagem.
    Endpoint: /api/postagem
    Parâmetros:
        titulo (string): Título da postagem.
        conteudo (string): Conteúdo da postagem.
        data_postagem (string): Data da postagem.
    Resposta: Mensagem de sucesso e detalhes da postagem em formato JSON se a criação for bem-sucedida; caso contrário, uma mensagem de erro com o código de status apropriado.

PUT /api/postagem

    Descrição: Atualiza uma postagem existente.
    Endpoint: /api/postagem
    Parâmetros:
        id (inteiro): ID da postagem a ser atualizada.
        titulo (string): Novo título da postagem.
        conteudo (string): Novo conteúdo da postagem.
        data_postagem (string): Nova data da postagem.
    Resposta: Mensagem de sucesso e detalhes atualizados da postagem em formato JSON se a atualização for bem-sucedida; caso contrário, uma mensagem de erro com o código de status apropriado.

DELETE /api/postagem

    Descrição: Remove uma postagem.
    Endpoint: /api/postagem
    Parâmetros:
        id (inteiro): ID da postagem a ser removida.
    Resposta: Mensagem de sucesso se a postagem for removida com sucesso; caso contrário, uma mensagem de erro com o código de status apropriado.

POST /api/postagem/filter

    Descrição: Filtra postagens com base em critérios específicos.
    Endpoint: /api/postagem/filter
    Parâmetros: Campos para filtrar (por exemplo, titulo, conteudo, data_postagem).
    Resposta: Array JSON contendo detalhes das postagens filtradas.

API do Controlador de Tags

GET /api/tags

    Descrição: Recupera todas as tags.
    Endpoint: /api/tags
    Parâmetros: Nenhum
    Resposta: Array JSON contendo detalhes das tags.

GET /api/tags/{id}

    Descrição: Recupera uma tag específica pelo ID.
    Endpoint: /api/tags/{id}
    Parâmetros:
        {id} (inteiro): ID da tag a ser recuperada.
    Resposta: Objeto JSON com detalhes da tag se encontrada; caso contrário, uma mensagem de erro com código de status 404.

POST /api/tags

    Descrição: Cria uma nova tag.
    Endpoint: /api/tags
    Parâmetros:
        title (string): Título da tag.
    Resposta: Mensagem de sucesso e detalhes da tag em formato JSON se a criação for bem-sucedida; caso contrário, uma mensagem de erro com o código de status apropriado.

PUT /api/tags

    Descrição: Atualiza uma tag existente.
    Endpoint: /api/tags
    Parâmetros:
        id (inteiro): ID da tag a ser atualizada.
        title (string): Novo título da tag.
    Resposta: Mensagem de sucesso e detalhes atualizados da tag em formato JSON se a atualização for bem-sucedida; caso contrário, uma mensagem de erro com o código de status apropriado.

DELETE /api/tags

    Descrição: Remove uma tag.
    Endpoint: /api/tags
    Parâmetros:
        id (inteiro): ID da tag a ser removida.
    Resposta: Mensagem de sucesso se a tag for removida com sucesso; caso contrário, uma mensagem de erro com o código de status apropriado.

POST /api/tags/filter

    Descrição: Filtra tags com base em critérios específicos.
    Endpoint: /api/tags/filter
    Parâmetros: Campos para filtrar (por exemplo, title).
    Resposta: Array JSON contendo detalhes das tags filtradas.
