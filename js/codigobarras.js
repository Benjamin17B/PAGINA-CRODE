// importa la biblioteca jsBarcode
import JsBarcode from 'jsbarcode';

// selecciona el elemento HTML donde se mostrará el código de barras
var barcode = document.getElementById('barcode');

// genera el código de barras con jsBarcode utilizando la variable `id`
JsBarcode(barcode, id.toString(), {
  format: 'ean13',
  displayValue: true,
  fontSize: 18,
  textMargin: 6,
  width: 2,
  height: 60,
  margin: 10
});