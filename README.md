## Documentação do Arquivo (Totem de Pedidos Spoleto)

Este código HTML/CSS/JavaScript simula um **Totem de Autoatendimento** interativo para pedidos de massa no estilo Spoleto. O front-end é totalmente contido em um único arquivo, utilizando JS nativo para gerenciar o estado (`pedido` object) e a navegação (`section` switching).

---

###  Estrutura e Estilização (HTML/CSS)

O layout é centrado e responsivo, projetado para se parecer com um **aplicativo de *smartphone*** dentro de um `main` com dimensões fixas (`max-width: 450px`, `max-height: 850px`).

| Componente | Classes CSS | Detalhes |
| :--- | :--- | :--- |
| **Paleta** | `:root` | Usa cores temáticas quentes (bege, amarelo, marrom) no estilo Spoleto. |
| **Container** | `main` | Define o visual do totem: cantos arredondados (`border-radius: 35px`), fundo bege e sombra forte. |
| **Telas** | `section` (`.ativa`) | Cada `section` é uma etapa do pedido. O CSS usa `display: none` e a classe `.ativa` (alternada por JS) para mostrar/esconder, com uma animação **`@keyframes fadeIn`** para transições suaves. |
| **Opções** | `.grid-opcoes` | Usa **CSS Grid** (`1fr 1fr`) para exibir as opções em duas colunas. Possui `overflow-y: auto` para rolagem. |
| **Card** | `.card` | Elemento clicável com transições. O estado `:active` usa **`transform: scale(0.96)`** para simular o *feedback* tátil. |
| **Botões** | `.btn-start`, `.btn-reset` | Botões principais com efeito "Puch" 3D: `box-shadow` que é removido e **`transform: translateY(4px)`** ao ser clicado. |
| **Voltar** | `.btn-voltar` | Botão secundário com estilo de contorno para navegação reversa. |

---

###  Funcionalidade JavaScript

O script gerencia o estado do pedido e a navegação.

| Variável/Função | Gatilho | Descrição |
| :--- | :--- | :--- |
| **`pedido`** | Variável global | Objeto JS (`{ Massa: '', Molho: '', Extra: '', Bebida: '' }`) que armazena a escolha do cliente em cada categoria. |
| **`navegar(atual, proximo)`** | `onclick` em botões (Voltar/Iniciar) | Alterna a classe `.ativa` entre as `section`s. Se o destino for `#tela-final`, chama `mostrarResumo()`. |
| **`escolherItem(cat, item, ...)`** | `onclick` nos `.card` | **Ação principal.** Armazena o `item` na `categoria` no objeto `pedido` e navega para a próxima tela. |
| **`mostrarResumo()`** | Chamado ao ir para `#tela-final` | Itera sobre o objeto `pedido`, cria dinamicamente os elementos `.resumo-item` e preenche a `div#lista-pedido` com as escolhas finais para conferência. |
| **`reiniciar()`** | `onclick` no `.btn-reset` | Reseta o objeto `pedido` e retorna a visualização para a `#tela1` (Início). |

---

###  Fluxo de Pedido (Telas)

O fluxo é sequencial (Massa -> Molho -> Extra) até a ramificação de Bebidas, convergindo para a tela final de resumo.

| Etapa | Telas Envolvidas | Foco |
| :--- | :--- | :--- |
| **Início** | `#tela1` | Bem-vindo / Botão INICIAR. |
| **Massa** | `#tela2` | Escolha do formato da massa (Penne, Spaghetti, etc.). |
| **Molho** | `#tela3` | Escolha do sabor do molho (Pomodoro, Branco, Bolonhesa, etc.). |
| **Extra** | `#tela4` | Escolha de acompanhamentos (Queijo Ralado, Bacon, Sem Extra). |
| **Bebidas (Menu)** | `#tela-bebidas` | Menu de seleção de subcategorias de bebidas. |
| **Bebidas (Sub)** | `#tela-refri` a `#tela-cerveja` | Seleção da bebida específica (e.g., Coca-Cola, Suco Laranja). |
| **Conclusão** | `#tela-final` | Exibe o resumo do pedido (`lista-pedido`) e o botão **NOVO PEDIDO**. |
