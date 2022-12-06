async function getToken(data){

    const query = await fetch('Boleta/get_token');
    const tokenData = await query.json();

<<<<<<< HEAD
    let cantidad;
    let tipo;

    if(data.tipo == 'COMPRA'){
        tipo = "COMPRA DE DÓLARES";
    }else{
        tipo = "VENTA DE DÓLARES";
    }

    const montoText = numeroALetras(data.recibe);
    const montoT = montoText.trim();
    const token = tokenData[0].token;
  
    data = { ...data, montoT, token, tipo };
=======
    let tipo;

		//no hemitimos las compras
		// if(data.tipo === "COMPRA") {
		// 	const respuesta = {sunatResponse: {success: true, tipo: "COMPRA"}}
		// 	return respuesta;
		// }
	 
			let TIPO = '';
			if(data.tipo == 'COMPRA'){
							TIPO = "COMPRA";
							tipo = `Compra de ${data.moneda} ${data.monto}`;
			}else{
							TIPO = "VENTA";
							tipo = `Venta de ${data.moneda} ${data.monto}`;
			}   
    const montoText = numeroALetras(data.recibe, data.moneda_recibe);
		
    const montoT = montoText.trim();
    const token = tokenData[0].token;
  
    data = { ...data, montoT, token, tipo, TIPO };
>>>>>>> master
    // console.log(data)
    const configData = configJson(data);

    // console.log(configData);

    const queryApi = await fetchApi(configData, token);
    const dataApi = await queryApi.json();
  //  console.log(dataApi)
<<<<<<< HEAD
    return dataApi;
}

function configJson(data){
 
=======

  return dataApi;
}

function configJson(data){

>>>>>>> master
    if(!data.cliente && data.clienteID == 0){
      data.cliente = ["REGULAR"];
    }

    if(!data.cliente && data.clienteID != 0){
      
      data.cliente = [];

      fetch('Clientes/get_cliente_id', {
          method: 'POST',
          headers: {
          'Content-Type': 'application/json',
          },
          body: JSON.stringify(data.clienteID)
        })
      .then(res => res.json())
      .then(res => {
        switch(res[0].doc_cliente){
          case "DNI":
              data.cliente[0] = 1;
              break;
          case "CE":
              data.cliente[0] = 4;
              break;
          case "RUC":
              data.cliente[0] = 6;
              break;
          case "PAS":
              data.cliente[0] = 7;
              break;
        }

        data.cliente[1] = res[0].n_cliente;
        data.cliente[2] = res[0].nom_cliente;
       
      })
    } 
<<<<<<< HEAD

    if(data.cliente.length === 1){
        data.cliente[0] = 1;
        data.cliente[1] = 10000001;
=======
		
    if(data.cliente.length === 1){
        data.cliente[0] = 0; //codigo o cliente general
        data.cliente[1] = 00000000;
>>>>>>> master
        data.cliente[2] = "CLIENTE";
    }else{
        
        switch(data.cliente[0]){
            case "DNI":
                data.cliente[0] = 1;
                break;
            case "CE":
                data.cliente[0] = 4;
                break;
            case "RUC":
                data.cliente[0] = 6;
                break;
            case "PAS":
              data.cliente[0] = 7;
              break;
        }
    }

    let date = new Date();
<<<<<<< HEAD
   
    // let fechaBoleta = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}T${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
    
    const boletaData = {
        "ublVersion": "2.1",
        "tipoOperacion": "0101",
        "tipoDoc": "03",
        "serie": "B001",
        "correlativo": data.correlativo,
        "fechaEmision": new Date("Y-m-dTH:i:s"),
        "formaPago": {
          "moneda": "PEN",
          "tipo": "Contado"
        },
        "tipoMoneda": "PEN",
        "client": {
          "tipoDoc": String(data.cliente[0]),
          "numDoc": Number(data.cliente[1]),
          "rznSocial": String(data.cliente[2]),
          "address": {
            "direccion": "LIMA",
            "provincia": "LIMA",
            "departamento": "LIMA",
            "distrito": "LIMA",
            "ubigueo": "150101"
          }
        },
        "company": {
          "ruc": 10064782261,
          "razonSocial": "Raúl Fernando Luna Toro",
          "nombreComercial": "ewforex.net",
          "address": {
            "direccion": "Av del éjercito 768, Miraflores",
            "provincia": "LIMA",
            "departamento": "LIMA",
            "distrito": "LIMA",
            "ubigueo": "150101"
          }
        },
        "mtoOperExoneradas": data.recibe,
        "mtoIGV": 0,
        "valorVenta": data.recibe,
        "totalImpuestos": 0,
        "subTotal": data.recibe,
        "mtoImpVenta": data.recibe,
        "details": [
          {
            "codProducto": "P001",
            "unidad": "NIU",
            "descripcion": data.tipo,
            "cantidad": data.monto,
            "mtoValorUnitario": data.cotizacion,
            "mtoValorVenta": data.recibe,
            "mtoBaseIgv": data.recibe,
            "porcentajeIgv": 0,
            "igv": 0,
            "tipAfeIgv": 20,
            "totalImpuestos": 0,
            "mtoPrecioUnitario": data.cotizacion
          }
        ],
        "legends": [
          {
            "code": "1000",
            "value": data.montoT
          }
        ]
    }
    // console.log(boletaData)
=======
		let IGV = 1.18;
	
		let PROMEDIO = data.promedio; //promedio para calcular la ganancia del ticket de venta
		let precioUnitario = data.cotizacionToSol - PROMEDIO;
    let montoValorUnitario = (data.cotizacionToSol - PROMEDIO) / IGV;
		// console.log("[promedio]",data.cotizacionToSol, PROMEDIO)
		
		let montoIgv = (precioUnitario * data.monto) - ((precioUnitario * data.monto) / IGV);

		let base = (montoValorUnitario * data.monto);

		// console.log("[cotizacionToSol]:", data.cotizacionToSol, PROMEDIO)
		let inefactoIva = {
			mtoIGV: montoIgv,
			porcentajeIgv: 18,
			igv: montoIgv,
			tipAfeIgv: 10,
			totalImpuestos: montoIgv,
			subTotal: base + montoIgv,
			mtoValorVenta: montoValorUnitario * data.monto
		}
		

		let gravadas = { mtoOperGravadas: base }
		//verificar promedio para calcular utilidad de la boleta
		if(data.tipo.split(" ")[0] === 'Compra'){
			PROMEDIO = data.cotizacion;
			inefactoIva = {
				mtoIGV: 0,
				porcentajeIgv: 18,
				igv: (((data.recibe / IGV) - data.recibe) * -1),
				tipAfeIgv: 21,
				totalImpuestos: (((data.recibe / IGV) - data.recibe) * -1),
				subTotal: 0,
				mtoValorVenta: 0,
				mtoOperGratuitas: data.cotizacion,
			}
			base = 0;
			montoValorUnitario = 0;
			precioUnitario = data.cotizacion;
			gravadas = { mtoOperExoneradas: (base).toFixed(2) }
		}

		const montoText = numeroALetras((base + montoIgv), data.moneda_recibe);
    const montoT = montoText.trim();
		// console.log(data)

    // let fechaBoleta = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}T${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
    let boletaData = {}
		if(data.TIPO === "COMPRA" || (data.moneda_recibe !== 'PEN' && data.moneda_recibe !== 'USD')) {
			
			console.log("{ok}",boletaData)
			try {
				//boletas tipo compra o sin ganancia "gratuitas"
				boletaData = {
					"ublVersion": "2.1",
					"tipoOperacion": "0101",
					"tipoDoc": "03",
					"serie": config.serieBoleta,
					"correlativo": data.correlativo,
					"fechaEmision": new Date("Y-m-dTH:i:s"),
					"formaPago": {
						// "moneda": data.tipoMoneda,
						"moneda": data.moneda_recibe,
						"tipo": "Contado"
					},
					// "tipoMoneda": data.tipoMoneda,
					"tipoMoneda": data.moneda_recibe,
					"client": {
						"tipoDoc": String(data.cliente[0]),
						"numDoc": Number(data.cliente[1]),
						"rznSocial": String(data.cliente[2]),
						"address": {
							"direccion": "LIMA",
							"provincia": "LIMA",
							"departamento": "LIMA",
							"distrito": "LIMA",
							"ubigueo": "150101"
						}
					},
					"company": {
						"ruc": config.ruc,
						"razonSocial": config.razonSocial,
						"nombreComercial": config.nombreComercial,
						"address": {
							"direccion": config.direccion,
							"provincia": "LIMA",
							"departamento": "LIMA",
							"distrito": "LIMA",
							"ubigueo": "150101"
						}
					},
					// "mtoOperExoneradas": data.dataMonto,
					// ...gravadas,
					// "mtoIGV": 0,
					"mtoIGV": 0,
					// "valorVenta": data.dataMonto,
					"valorVenta": 0,
					// "totalImpuestos": 0,
					"totalImpuestos": 0,
					// "subTotal": data.dataMonto,
					"subTotal": 0,
					// "mtoImpVenta": data.dataMonto,
					"mtoImpVenta": 0,
					"mtoIGVGratuitas": 0,
					"mtoOperGratuitas": data.recibe,
					"details": [
						{
							"codProducto": "P001",
							"unidad": "NIU",
							// "descripcion": data.tipo,
							"descripcion": `${data.tipo} * ${data.cotizacion} = ${data.recibe} ${data.moneda_recibe}`,
							// "cantidad": 1,
							"cantidad": data.monto,
							// "mtoValorUnitario": data.dataMonto,
							"mtoValorUnitario": 0,
							// "mtoValorVenta": data.dataMonto,
							"mtoValorVenta": data.recibe,
							// "mtoBaseIgv": data.dataMonto,
							"mtoBaseIgv": data.recibe,
							// "porcentajeIgv": 0,
							"porcentajeIgv": 0,
							// "igv": 0,
							"igv": 0,
							// "tipAfeIgv": 20,
							"tipAfeIgv": inefactoIva.tipAfeIgv,
							// "totalImpuestos": 0,
							"totalImpuestos": 0,
							// "mtoPrecioUnitario": data.dataMonto
							"mtoPrecioUnitario": 0,
							"mtoValorGratuito": precioUnitario,
						}
					],
					"legends": [
						{
							"code": "1002",
							// "value": data.montoT
							// "value": 
							"value": "COMPRA DE DIVISA - TRANSFERENCIA GRATUITA DE UN BIEN Y/O SERVICIO PRESTADO GRATUITAMENTE"
						}
					]
				}
			} catch (error) {
				console.log(error)
			}
					

		}else{
			//boletas tipo venta con ganancia
			boletaData = {
						"ublVersion": "2.1",
						"tipoOperacion": "0101",
						"tipoDoc": "03",
						"serie": config.serieBoleta,
						"correlativo": data.correlativo,
						"fechaEmision": new Date("Y-m-dTH:i:s"),
						"formaPago": {
							// "moneda": data.tipoMoneda,
							"moneda": "PEN",
							"tipo": "Contado"
						},
						// "tipoMoneda": data.tipoMoneda,
						"tipoMoneda": "PEN",
						"client": {
							"tipoDoc": String(data.cliente[0]),
							"numDoc": Number(data.cliente[1]),
							"rznSocial": String(data.cliente[2]),
							"address": {
								"direccion": "LIMA",
								"provincia": "LIMA",
								"departamento": "LIMA",
								"distrito": "LIMA",
								"ubigueo": "150101"
							}
						},
						"company": {
							"ruc": config.ruc,
							"razonSocial": config.razonSocial,
							"nombreComercial": config.nombreComercial,
							"address": {
								"direccion": config.direccion,
								"provincia": "LIMA",
								"departamento": "LIMA",
								"distrito": "LIMA",
								"ubigueo": "150101"
							}
						},
						// "mtoOperExoneradas": data.dataMonto,
						...gravadas,
						// "mtoIGV": 0,
						"mtoIGV": inefactoIva.mtoIGV,
						// "valorVenta": data.dataMonto,
						"valorVenta": base,
						// "totalImpuestos": 0,
						"totalImpuestos": inefactoIva.totalImpuestos,
						// "subTotal": data.dataMonto,
						"subTotal": inefactoIva.subTotal,
						// "mtoImpVenta": data.dataMonto,
						"mtoImpVenta": inefactoIva.subTotal,
						"details": [
							{
								"codProducto": "P001",
								"unidad": "NIU",
								// "descripcion": data.tipo,
								"descripcion": `${data.tipo} * ${data.cotizacion} = ${data.recibe} ${data.moneda_recibe}`,
								// "cantidad": 1,
								"cantidad": data.monto,
								// "mtoValorUnitario": data.dataMonto,
								"mtoValorUnitario": montoValorUnitario,
								// "mtoValorVenta": data.dataMonto,
								"mtoValorVenta": inefactoIva.mtoValorVenta,
								// "mtoBaseIgv": data.dataMonto,
								"mtoBaseIgv": base,
								// "porcentajeIgv": 0,
								"porcentajeIgv": inefactoIva.porcentajeIgv,
								// "igv": 0,
								"igv": inefactoIva.igv,
								// "tipAfeIgv": 20,
								"tipAfeIgv": inefactoIva.tipAfeIgv,
								// "totalImpuestos": 0,
								"totalImpuestos": inefactoIva.totalImpuestos,
								// "mtoPrecioUnitario": data.dataMonto
								"mtoPrecioUnitario": precioUnitario
							}
						],
						"legends": [
							{
								"code": "1000",
								// "value": data.montoT
								"value": montoT
							}
						]
				}
		}
    console.log(boletaData)
>>>>>>> master
    return boletaData;
}

function fetchApi(data, token){
    return fetch('https://facturacion.apisperu.com/api/v1/invoice/send', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'Authorization': token
        },
        body: JSON.stringify(data)
    })
}

function fetcBaja(data, token){
<<<<<<< HEAD
  return fetch('https://facturacion.apisperu.com/api/v1/voided/send', {
=======
  return fetch('https://facturacion.apisperu.com/api/v1/summary/send', {
>>>>>>> master
      method: 'POST',
      headers: {
      'Content-Type': 'application/json',
      'Authorization': token
      },
      body: JSON.stringify(data)
  })
}

<<<<<<< HEAD
async function sendBaja(id, fecha){
=======
async function sendBaja(correlativo, fecha, mon_recibe, recibe, docCliente, numCliente, utilidad, tipo, total){
>>>>>>> master

  const query = await fetch('Boleta/get_token');
  const tokenData = await query.json();
  const token = tokenData[0].token;

  let date = new Date(fecha);
  let fechaBoleta = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}T00:00:00-22:00`;
<<<<<<< HEAD
  
  const JSONBaja = {
    "correlativo": id,
    "fecGeneracion": fechaBoleta,
    "fecComunicacion": fechaBoleta,
    "company": {
      "ruc": 10064782261,
      "razonSocial": "Raúl Fernando Luna Toro",
      "nombreComercial": "ewforex.net",
      "address": {
        "direccion": "Av del éjercito 768, Miraflores",
        "provincia": "LIMA",
        "departamento": "LIMA",
        "distrito": "LIMA",
        "ubigueo": "150101"
      }
    },
    "details": [
      {
        "tipoDoc": "01",
        "serie": "F001",
        "correlativo": id,
        "desMotivoBaja": "ANULADO"
      },
    ]
  }

=======

	if(docCliente === ''){
		docCliente = 0;
	}else{
		switch(docCliente){
						case "DNI":
							docCliente = 1;
								break;
						case "CE":
							docCliente = 4;
								break;
						case "RUC":
							docCliente = 6;
								break;
						case "PAS":
							docCliente = 7;
								break;
					}
		}
  
  let dataMonto =  utilidad;
	let igv = utilidad - (utilidad / 1.18);
	let moneda = 'PEN';
	
  if(tipo =="COMPRA"){
		
		dataMonto = total;
		igv = 0;
		
	}

		const JSONBaja = {
			"fecGeneracion": fechaBoleta,
			"fecResumen": fechaBoleta,
			"correlativo": correlativo,
			"moneda": moneda,
			"company": {
				"ruc": config.ruc,
				"razonSocial": config.razonSocial,
				"nombreComercial": config.nombreComercial,
				"address": {
					"direccion": config.direccion,
					"provincia": "LIMA",
					"departamento": "LIMA",
					"distrito": "LIMA",
					"ubigueo": "150101"
				}
			},
			"details": [
				{
					"tipoDoc": "03",
					"serieNro": `${config.serieBoleta}-${correlativo}`,
					"estado": "3",
					"clienteTipo": String(docCliente),
					"clienteNro": String(numCliente),
					"total": parseFloat(dataMonto),
					"mtoOperGravadas": 0,
					"mtoOperInafectas": 0,
					"mtoOperExoneradas": 0,
					"mtoOperExportacion": 0,
					"mtoOtrosCargos": 0,
					"mtoIGV": parseFloat(igv)
				}
			]
		}


	
	// console.log(correlativo, fecha, mon_recibe, recibe, docCliente, numCliente, utilidad, tipo, total)
	
	// console.log(JSONBaja)
>>>>>>> master
  return fetcBaja(JSONBaja, token);
}

async function configJsonPdf(data){

  //obteniendo el token
  const query = await fetch('Boleta/get_token');
  const tokenData = await query.json();
  const token = tokenData[0].token;
  data.cliente = [];

  //si el cliente es generico
  if(data.cli_operacion == 0){

<<<<<<< HEAD
      data.cliente[0] = 1;
      data.cliente[1] = 10000001;
=======
      data.cliente[0] = 0;
      data.cliente[1] = 00000000;
>>>>>>> master
      data.cliente[2] = "CLIENTE";

  }else{
    //obteniendo el cliente
    const queryCustomer = await fetch('Clientes/get_cliente_id', {
      method: 'POST',
      headers: {
      'Content-Type': 'application/json',
      },
      body: JSON.stringify(data.cli_operacion)
    });
    const customer = await queryCustomer.json();
<<<<<<< HEAD

    switch(customer.doc_cliente){
=======
    
    switch(customer[0].doc_cliente){
>>>>>>> master
          case "DNI":
              data.cliente[0] = 1;
              break;
          case "CE":
              data.cliente[0] = 4;
              break;
          case "RUC":
              data.cliente[0] = 6;
              break;
          case "PAS":
            data.cliente[0] = 7;
            break;
    }
<<<<<<< HEAD

    data.cliente[1] = customer.n_cliente;
    data.cliente[2] = customer.nom_cliente;

=======
    data.cliente[1] = customer[0].n_cliente;
    data.cliente[2] = customer[0].nom_cliente;
>>>>>>> master
  }

  // console.log(data, token);

  let tipo;
  if(data.tip_operacion == 'COMPRA'){
<<<<<<< HEAD
    tipo = "COMPRA DE DÓLARES";
  }else{
    tipo = "VENTA DE DÓLARES";
  }

  const montoText = numeroALetras(data.rec_operacion);
  const montoT = montoText.trim();
=======
    tipo = `Compra de ${data.div_operacion}`;
  }else{
    tipo = `Venta de ${data.div_operacion}`;
  }

  
>>>>>>> master

  //ajuste fecha y hora
  let date = new Date(data.fec_operacion);
  let year = date.getFullYear();
  let mes = date.getMonth() + 1;
  let dia = date.getDate();
  let hora = date.getHours('11');
  let minutos = date.getMinutes() >= 10 ? date.getMinutes() : `0${date.getMinutes()}`;
  let segundos = date.getSeconds();
  // let fechaBoleta = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}T${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
  // console.log(`${year}-${mes}-${dia}T${hora}:${minutos}:${segundos}-05:00`)

<<<<<<< HEAD
=======
	const montoText = numeroALetras(data.rec_operacion, data.mon_rec_operacion);
  const montoT = montoText.trim();

	//si la boleta es venta se coloca el correlativo de sunat, si no el numero de operacion interno
	//ya que no se emite a sunat
	let corelativo = data.correlative_sunat;
	if(data.tip_operacion === 'Compra'){
		corelativo = data.id_operacion;
	}

>>>>>>> master
  const boletaData = {
    "ublVersion": "2.1",
    "tipoOperacion": "0101",
    "tipoDoc": "03",
<<<<<<< HEAD
    "serie": "B001",
    "correlativo": data.correlative_sunat,
    "fechaEmision": `${year}-${mes}-${dia}T${hora}:${minutos}:${segundos}-05:00`,
    "formaPago": {
      "moneda": "PEN",
      "tipo": "Contado"
    },
    "tipoMoneda": "PEN",
=======
    "serie": config.serieBoleta,
    "correlativo": corelativo,
    "fechaEmision": `${year}-${mes}-${dia}T${hora}:${minutos}:${segundos}-05:00`,
    "formaPago": {
      "moneda": data.div_operacion,
      "tipo": "Contado"
    },
    "tipoMoneda": data.mon_rec_operacion,
>>>>>>> master
    "client": {
      "tipoDoc": data.cliente[0],
      "numDoc": data.cliente[1],
      "rznSocial": data.cliente[2],
      "address": {
        "direccion": "LIMA",
        "provincia": "LIMA",
        "departamento": "LIMA",
        "distrito": "LIMA",
        "ubigueo": "150101"
      }
    },
    "company": {
<<<<<<< HEAD
      "ruc": 10064782261,
      "razonSocial": "Raúl Fernando Luna Toro",
      "nombreComercial": "ewforex.net",
      "address": {
        "direccion": "Av del éjercito 768, Miraflores",
=======
      "ruc": config.ruc,
      "razonSocial": config.razonSocial,
      "nombreComercial": config.nombreComercial,
      "address": {
        "direccion": config.direccion,
>>>>>>> master
        "provincia": "LIMA",
        "departamento": "LIMA",
        "distrito": "LIMA",
        "ubigueo": "150101"
      }
    },
    "mtoOperExoneradas": data.rec_operacion,
    "mtoIGV": 0,
    "valorVenta": data.rec_operacion,
    "totalImpuestos": 0,
    "subTotal": data.rec_operacion,
    "mtoImpVenta": data.rec_operacion,
    "details": [
      {
        "codProducto": "P001",
        "unidad": "NIU",
        "descripcion": tipo,
        "cantidad": data.mon_operacion,
        "mtoValorUnitario": data.cot_operacion,
        "mtoValorVenta": data.rec_operacion,
        "mtoBaseIgv": data.rec_operacion,
        "porcentajeIgv": 0,
        "igv": 0,
<<<<<<< HEAD
        "tipAfeIgv": 20,
=======
        "tipAfeIgv": 30,
>>>>>>> master
        "totalImpuestos": 0,
        "mtoPrecioUnitario": data.cot_operacion
      }
    ],
    "legends": [
      {
        "code": "1000",
        "value": montoT
      }
    ]
}
<<<<<<< HEAD
  // console.log(boletaData)
=======
	
// 		let PROMEDIO = 3.940662; //promedio para calcular la ganancia del ticket de venta
// 		let IGV = 1.18;

//     let precioUnitario = data.cot_operacion - PROMEDIO;
//     let montoValorUnitario = (data.cot_operacion - PROMEDIO) / IGV;
		
// 		let montoIgv = (precioUnitario * data.mon_operacion) - ((precioUnitario * data.mon_operacion) / IGV);

// 		let base = (montoValorUnitario * data.mon_operacion);

	
// 		let inefactoIva = {
// 			mtoIGV: montoIgv,
// 			porcentajeIgv: 18,
// 			igv: montoIgv,
// 			tipAfeIgv: 10,
// 			totalImpuestos: montoIgv,
// 			subTotal: base + montoIgv,
// 			mtoValorVenta: montoValorUnitario * data.mon_operacion
// 		}
		

// 		let gravadas = { mtoOperGravadas: base }
// 		//verificar promedio para calcular utilidad de la boleta
// 		if(data.tip_operacion === 'Compra'){
// 			PROMEDIO = data.cot_operacion;
// 			inefactoIva = {
// 				mtoIGV: 0,
// 				porcentajeIgv: 0,
// 				igv: 0,
// 				tipAfeIgv: 30,
// 				totalImpuestos: 0,
// 				subTotal: 0,
// 				mtoValorVenta: data.recibe
// 			}
// 			base = data.recibe;
// 			montoValorUnitario = 0;
// 			precioUnitario = 0
// 			gravadas = { mtoOperExoneradas: base }
// 		}


// 		const montoText = numeroALetras((base + montoIgv), data.mon_rec_operacion);
//     const montoT = montoText.trim();

// const boletaData = {
// 	    "ublVersion": "2.1",
// 	    "tipoOperacion": "0101",
// 	    "tipoDoc": "03",
// 	    "serie": config.serieBoleta,
// 	    "correlativo": data.correlative_sunat,
// 	    "fechaEmision": `${year}-${mes}-${dia}T${hora}:${minutos}:${segundos}-05:00`,
// 	    "formaPago": {
// 	      "moneda": data.div_operacion,
// 	      "tipo": "Contado"
// 	    },
// 	    "tipoMoneda": data.mon_rec_operacion,
// 	    "client": {
// 	      "tipoDoc": data.cliente[0],
// 	      "numDoc": data.cliente[1],
// 	      "rznSocial": data.cliente[2],
// 	      "address": {
// 	        "direccion": "LIMA",
// 	        "provincia": "LIMA",
// 	        "departamento": "LIMA",
// 	        "distrito": "LIMA",
// 	        "ubigueo": "150101"
// 	      }
// 	    },
// 	    "company": {
// 	      "ruc": config.ruc,
// 	      "razonSocial": config.razonSocial,
// 	      "nombreComercial": config.nombreComercial,
// 	      "address": {
// 	        "direccion": config.direccion,
// 	        "provincia": "LIMA",
// 	        "departamento": "LIMA",
// 	        "distrito": "LIMA",
// 	        "ubigueo": "150101"
// 	      }
// 	    },
// 	    // "mtoOperExoneradas": data.recibe,
//         // "mtoOperExoneradas": 0,
// 				...gravadas ,
//         // "mtoIGV": 0,
//         "mtoIGV": inefactoIva.mtoIGV,
//         // "valorVenta": data.recibe,
//         "valorVenta": base,
//         // "totalImpuestos": 0,
//         "totalImpuestos": inefactoIva.totalImpuestos,
//         "subTotal": inefactoIva.subTotal,
//         "mtoImpVenta": inefactoIva.subTotal,
// 	    "details": [
// 				{
// 					"codProducto": "P001",
// 					"unidad": "NIU",
// 					"descripcion": `${tipo} ${data.mon_operacion} * ${data.cot_operacion} = ${data.rec_operacion} ${data.mon_rec_operacion}`,
// 					"cantidad": data.mon_operacion,
// 					// "cantidad": data.monto,
// 					"mtoValorUnitario": montoValorUnitario,
// 					// "mtoValorVenta": data.recibe,
// 					"mtoValorVenta":inefactoIva.mtoValorVenta,
// 					// "mtoBaseIgv": data.recibe,
// 					"mtoBaseIgv": base,
// 					// "porcentajeIgv": 0,
// 					"porcentajeIgv": 18,
// 					// "igv": 0,
// 					"igv": inefactoIva.igv,
// 					// "tipAfeIgv": 20,
// 					"tipAfeIgv": inefactoIva.tipAfeIgv,
// 					// "totalImpuestos": 0,
// 					"totalImpuestos": inefactoIva.totalImpuestos,
// 					"mtoPrecioUnitario": precioUnitario
// 				}
// 	    ],
// 	    "legends": [
// 	      {
// 	        "code": "1000",
// 	        "value": montoT
// 	      }
// 	    ]
// 	}
//   console.log(boletaData)
>>>>>>> master
  return apiPdf(boletaData, token);
}

function apiPdf(data, token){
  return fetch('https://facturacion.apisperu.com/api/v1/invoice/pdf', {
      method: 'POST',
      headers: {
      'Content-Type': 'application/json',
      'Authorization': token
      },
      body: JSON.stringify(data)
  })
}

function formatDate(dateOperation){

  let date = new Date(dateOperation);

  let fechaBoleta = `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}T${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;

  return fechaBoleta;
<<<<<<< HEAD
}
=======
}

const config = {
	ruc: 10012345678,
	razonSocial: "CARDENAS RAMOS MARI LUZ TRIGIDIA",
  nombreComercial: "El Fiel Test",
  direccion: "Avenida Tomas Marsano 2819-Urbanizacion Higuereta. Santiago de Surco, Lima.",
	telefono: "000 000 000",
	serieBoleta: 'B001',
	regimen: "General"
}
>>>>>>> master
