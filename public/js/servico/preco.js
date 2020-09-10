function servicoValor()
{
    var total = 0;
    valor = document.getElementsByName("valor[]");
    quantidade = document.getElementsByName("quantidade[]");
    total_unidade = document.getElementsByName("total[]");
    valor_total = document.getElementsByName("valor_total");
    for (var x = 0; x < valor.length; x++)
    {
        valor_unidade = parseFloat(valor[x].value);
        quantidade_servico = parseFloat(quantidade[x].value);
        
        if (!isNaN(valor_unidade) && !isNaN(quantidade_servico))
        {
            if (valor_unidade !== "" && quantidade_servico !== "")
            {
                if (quantidade_servico > 1 || quantidade_servico < 0)
                {
                    alert('Quantidade não pode ser maior que 1 ou menor que 0!');
                    quantidade.value = 1;
                }
                else
                {
                    total += valor_unidade * quantidade_servico;
                    total_unidade[x].value = valor_unidade * quantidade_servico;
                }
            }
            else
            {
                total_unidade[x].value = 0;
            }
        }
        else
        {
            total_unidade[x].value = 0;
        }
    }
    if (isNaN(total))
    {
        valor_total[0].value = 0;
    }
    else
    {
        valor_total[0].value = parseFloat(total);
    }
}