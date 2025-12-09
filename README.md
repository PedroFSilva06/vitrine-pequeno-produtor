# 🥬 Vitrine do Pequeno Produtor

> **Projeto de Extensão Universitária | Desenvolvimento Web Full-Stack**

A **Vitrine do Pequeno Produtor** é uma plataforma web desenvolvida para mitigar a exclusão digital de pequenos agricultores e artesãos locais. O sistema elimina intermediários, conectando quem produz diretamente a quem consome, fomentando a economia circular e regional.

---

## 🎯 Objetivo e Impacto Social
Muitos microempreendedores rurais não possuem acesso a ferramentas de e-commerce devido à complexidade e custos. Este projeto oferece:
* **Visibilidade Gratuita:** Um catálogo online simples e elegante.
* **Negociação Direta:** Integração via API do WhatsApp para fechar vendas sem taxas.
* **Gestão Autônoma:** Painel administrativo (Dashboard) onde o próprio produtor gerencia seus itens.

Este projeto alinha-se aos **Objetivos de Desenvolvimento Sustentável (ODS)** da ONU:
* **ODS 8:** Trabalho Decente e Crescimento Econômico.
* **ODS 11:** Cidades e Comunidades Sustentáveis.

---

## 🚀 Funcionalidades

### 🛒 Área Pública (Consumidor)
* **Catálogo Visual:** Exibição de produtos com fotos, preços e categorias.
* **Busca e Filtros:** Pesquisa por nome (ex: "Queijo") ou categorias (Hortifruti, Doces, Artesanato).
* **Modal de Detalhes:** Visualização expandida com dados do fornecedor.
* **Botão "Comprar":** Redirecionamento automático para o WhatsApp do produtor com mensagem pré-preenchida.

### 👨‍🌾 Área do Produtor (Restrita)
* **Autenticação Segura:** Login e Cadastro com criptografia de senha.
* **Dashboard de Gestão:** Visão geral dos produtos cadastrados.
* **CRUD Completo:** Adicionar, Editar e Excluir produtos.
* **Perfil Automático:** O WhatsApp e dados de contato são vinculados automaticamente aos produtos.

---

## 🛠️ Tecnologias Utilizadas

O projeto foi construído utilizando a arquitetura **MVC (Model-View-Controller)** para garantir organização e escalabilidade.

* **Back-end:** PHP 8.0+ (PDO, Sessões, Orientação a Objetos).
* **Banco de Dados:** MySQL (Relacional).
* **Front-end:** HTML5, CSS3, Bootstrap 5 (Responsivo).
* **UI/UX:** SweetAlert2 (Alertas animados), Google Fonts (Poppins), Animações CSS.
* **Versionamento:** Git & GitHub.

---

## 📦 Como Rodar o Projeto Localmente

### Pré-requisitos
* Ter o **XAMPP** (ou similar) instalado com Apache e MySQL.

### Passo a Passo

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/SEU-USUARIO/vitrine-pequeno-produtor.git](https://github.com/SEU-USUARIO/vitrine-pequeno-produtor.git)
    ```

2.  **Mova a pasta:**
    Coloque a pasta do projeto dentro do diretório `htdocs` do seu XAMPP (`C:\xampp\htdocs\vitrine-pequeno-produtor`).

3.  **Configure o Banco de Dados:**
    * Abra o **phpMyAdmin** (`http://localhost/phpmyadmin`).
    * Crie um banco de dados chamado `vitrine_db`.
    * Importe o arquivo `database.sql` que está na raiz deste projeto.
    * *Ou copie e cole o SQL manualmente na aba SQL.*

4.  **Acesse no Navegador:**
    * Digite: `http://localhost/vitrine-pequeno-produtor/`

---


## 📄 Licença

Este projeto foi desenvolvido para fins acadêmicos e extensionistas. Sinta-se à vontade para contribuir!

---
*Desenvolvido por Pedro Ferreira da Silva - ADS*
