export const FormatNumber = (valor, digitos, style = false,pais='PE') => {
    let format = new Intl.NumberFormat(Pais(pais).format, {
        currency: Pais(pais).moneda,
        minimumFractionDigits: digitos,
        maximumFractionDigits: digitos,
        style: style ? 'currency' : undefined
    }).format(isNaN(Number(valor)) ? 0 : Number(valor));
    return format.replace(",", "");
}

function Pais(pais){
    switch(pais){
        case 'PE':{
            return {
                format:'es-PE',
                moneda:'PEN'
            }
        }
        case 'US':{
            return {
                format:'en-US',
                moneda:'USD'
            }
        }
    }
}