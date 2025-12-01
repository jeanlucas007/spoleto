#  Documentação do salvar_pedido: Registro de Pedidos

Este script PHP atua como um endpoint de API simples ("backend") para receber dados de pedidos em formato JSON e armazená-los em um arquivo local (`pedidos.json`).

##  Visão Geral

- **Função:** Recebera, processar e persistir pedidos.
- **Método HTTP:** `POST`
- **Formato de Entrada:** JSON (Raw Body)
- **Armazenamento:** Arquivo local `pedidos.json`

---

##  Fluxo de Execução

1. **Recepção:** O script lê o corpo da requisição (`php://input`).
2. **Validação:** Verifica se o JSON é válido e não está vazio.
3. **Persistência:**
    - Se o arquivo `pedidos.json` não existir, ele é criado.
    - Lê os pedidos existentes.
    - Adiciona um carimbo de data/hora (`timestamp`) ao novo pedido.
    - Anexa o novo pedido à lista.
4. **Salvamento:** Grava o array atualizado no arquivo com formatação legível (`JSON_PRETTY_PRINT`).
5. **Resposta:** Retorna um JSON de confirmação para o cliente.

---

## 💻 Como integrar (Exemplo em JavaScript)

Abaixo um exemplo de como enviar uma requisição para este arquivo usando a Fetch API:

```javascript
const novoPedido = {
    cliente: "João da Silva",
    mesa: 5,
    itens: [
        { produto: "Hambúrguer", quantidade: 2, preco: 25.00 },
        { produto: "Coca-Cola", quantidade: 2, preco: 5.00 }
    ],
    total: 60.00
};

fetch('caminho/para/seu_script.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(novoPedido)
})
.then(response => response.json())
.then(data => {
    if(data.status === 'ok') {
        console.log('Sucesso:', data.mensagem);
    } else {
        console.error('Erro:', data.erro);
    }
})
.catch(error => console.error('Erro na requisição:', error));
