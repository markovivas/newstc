# NewSTC - Tema WordPress para Notícias Corporativas

`NewSTC` é um tema moderno, limpo e responsivo para WordPress, projetado especificamente para portais de notícias corporativas, intranets e sites de comunicação interna. Com um design focado na legibilidade e na experiência do usuário, o tema oferece funcionalidades avançadas para destacar conteúdo e facilitar o acesso à informação.

**Versão:** 1.0
**Autor:** Marco Antonio Vivas

---

## ✨ Funcionalidades Principais

*   **Design Moderno e Responsivo:** Layout adaptável para uma visualização perfeita em desktops, tablets e celulares.
*   **Página Inicial Configurável:** Seções pré-definidas para herói, notícias em destaque, últimas notícias e acesso rápido.
*   **Botões de Acesso Rápido Gerenciáveis:** Crie, edite, ordene e remova os botões de atalho da página inicial diretamente pelo painel do WordPress, através de um Custom Post Type dedicado.
*   **Notícias em Destaque por Categoria:** Destaque posts na página inicial simplesmente adicionando-os à categoria "Destaque".
*   **Layout de Post Otimizado:** Página de post com design focado no conteúdo, sem distrações, com tempo de leitura estimado e botões de compartilhamento social e impressão.
*   **Áreas de Widgets:** Múltiplas áreas para widgets, incluindo uma sidebar principal e três colunas no rodapé.
*   **Menus Configuráveis:** Duas localizações de menu: um principal no cabeçalho e um secundário no rodapé.
*   **Otimizado para SEO:** Estrutura de código limpa e adição de Schema Markup (JSON-LD) para artigos, melhorando a visibilidade nos motores de busca.
*   **Performance:** Otimizações como remoção de emojis e lazy loading para imagens.

---

## 🚀 Instalação

1.  Faça o download do arquivo `.zip` do tema.
2.  No painel do WordPress, navegue até **Aparência > Temas**.
3.  Clique em **Adicionar novo** e depois em **Enviar tema**.
4.  Selecione o arquivo `.zip` que você baixou e clique em **Instalar agora**.
5.  Após a instalação, clique em **Ativar**.

---

## ⚙️ Configuração do Tema

Após ativar o tema, siga estes passos para configurar seu site.

### 1. Configurar a Página Inicial

O tema `NewSTC` foi projetado para usar uma página inicial estática.

1.  Crie uma nova página em **Páginas > Adicionar nova** e dê a ela o título de "Início" (ou como preferir).
2.  Crie outra página chamada "Blog" ou "Notícias" para ser a página de listagem dos posts.
3.  Vá para **Configurações > Leitura**.
4.  Em "Sua página inicial exibe", selecione **Uma página estática**.
5.  Para "Página inicial", selecione a página "Início" que você criou.
6.  Para "Página de posts", selecione a página "Blog" ou "Notícias".
7.  Salve as alterações.

### 2. Menus

O tema possui duas localizações de menu:

*   **Menu Principal:** Exibido no cabeçalho.
*   **Menu do Rodapé:** Exibido no rodapé do site.

Vá para **Aparência > Menus** para criar seus menus e atribuí-los às suas respectivas localizações.

### 3. Notícias em Destaque

A seção "Notícias em Destaque" na página inicial exibe os posts de uma categoria específica.

1.  Vá para **Posts > Categorias**.
2.  Crie uma nova categoria com o nome **Destaque**. O slug (URL amigável) deve ser `destaque`.
3.  Para que um post apareça nesta seção, basta atribuir a ele a categoria "Destaque". Os 2 posts mais recentes desta categoria serão exibidos.

### 4. Botões de Acesso Rápido (Home)

Os botões de atalho na página inicial são gerenciados através de um tipo de post personalizado chamado "Acesso Rápido".

1.  No menu lateral do painel, clique em **Acesso Rápido > Adicionar Novo**.
2.  **Título:** Será o título do botão (ex: "Últimas Notícias").
3.  **Editor de Conteúdo:** O texto que você inserir aqui será a descrição curta do botão.
4.  **Caixa "Detalhes do Botão"**:
    *   **Ícone:** Insira a classe do ícone desejado do Font Awesome (ex: `fas fa-newspaper`).
    *   **Link do Botão:** Insira a URL de destino para onde o botão deve levar.
5.  **Caixa "Atributos da página" (na barra lateral direita)**:
    *   Use o campo **Ordem** para definir a posição do botão (0 para o primeiro, 1 para o segundo, e assim por diante).
6.  Clique em **Publicar**.

Você pode adicionar, editar ou remover quantos botões desejar.

### 5. Widgets

O tema oferece 4 áreas de widgets:

*   **Sidebar Principal:** Aparece ao lado do conteúdo em páginas de arquivo (como o blog).
*   **Rodapé - Coluna 1, 2 e 3:** Permitem adicionar conteúdo em três colunas no rodapé do site.

Vá para **Aparência > Widgets** para adicionar e configurar os widgets.

### 6. Informações de Contato e Redes Sociais

As informações de contato (telefone, e-mail) e os links para redes sociais exibidos no topo e no rodapé podem ser configurados através do **Personalizador** do WordPress.

1.  Vá para **Aparência > Personalizar**.
2.  Procure pelas seções correspondentes para inserir suas informações.

*(Nota: Se as seções não existirem, elas precisam ser criadas no arquivo `functions.php` usando a API do Customizer).*

---

## 🧱 Dependências

O tema utiliza as seguintes bibliotecas externas:

*   **Google Fonts:** Para as fontes `Inter` e `Plus Jakarta Sans`.
*   **Font Awesome:** Para os ícones utilizados em todo o site.

Esses recursos são carregados automaticamente pelo tema.

---

## 📄 Licença

Este tema é licenciado sob a **GNU General Public License v2.0** ou posterior.
Você pode encontrar o texto completo da licença em: http://www.gnu.org/licenses/gpl-2.0.html

---

## 👨‍💻 Créditos

Desenvolvido e mantido por **Marco Antonio Vivas**.