import{aO as X,h as n,g as Y,p as c,s as Z,c as ee,w as l,z as te,o as k,b as t,k as f,u as i,a as s,f as F,l as oe,q as V,t as N,F as le}from"./app.50683a97.js";import{T as ae}from"./TenantLayout.4c67b316.js";import{C as de}from"./CardView.5dc7dcb1.js";import{F as _}from"./helpers.09edc9ed.js";import{V as se}from"./VBreadcrumbs.c34b1911.js";import{a as w,b as r,V as b,g as P}from"./index.4549214f.js";import{V as g}from"./VTextField.65545f13.js";import{V as D}from"./VSelect.1e68f7fa.js";import{V as ue}from"./VCombobox.494f4cab.js";import{V as ne}from"./VTable.b15a6983.js";import{p as $,h as j,b as re,a as ie}from"./VNavigationDrawer.8088819a.js";import{V as ce}from"./VForm.9f532f63.js";import{V as me}from"./VDialog.52eddf4b.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./VCheckboxBtn.fafb4134.js";import"./VChip.0d8836c3.js";const ve=s("thead",{class:"text-uppercase bg-thead-primary"},[s("tr",null,[s("th",{class:"text-center",style:{width:"10%"}},"Accion"),s("th",{class:"text-center",style:{width:"10%"}},"Cantidad"),s("th",{class:"text-center",style:{width:"60%"}},"Producto"),s("th",{class:"text-center",style:{width:"10%"}},"Costo Uni."),s("th",{class:"text-center",style:{width:"10%"}},"Total")])],-1),pe={class:"text-center"},fe={class:"text-center"},be={class:"text-center"},Ve={class:"text-center"},_e={key:1},ge=s("td",{colspan:"5"},[s("strong",null,"No hay items")],-1),ye=[ge],Ne=s("td",{colspan:"4",class:"text-right"}," Total ",-1),Ce={class:"text-center"},Me={__name:"Create",props:["consultas","fecha"],setup(z){const y=z,I=X(),U=n([]),O=n([]),A=n([]),L=n([]),m=n(""),v=n(""),C=n(null),E=n(null),T=n(null),x=n(!1);let p=n([]);const d=n({producto_id:0,cantidad:0,costo:0,producto:""}),h=n(null),S=n(null),B=n(0),u=Y({id:0,fecha:"",origen:0,destino:0,moneda:"",detalles:[],total:0});function G(){te.Inertia.reload({only:["consultas"],onSuccess:()=>{U.value=y.consultas.monedas,O.value=y.consultas.origenes,A.value=y.consultas.destinos,L.value=y.consultas.productos,h.value=y.fecha}})}c(h,e=>{u.fecha=e}),c(S,e=>{u.moneda=e.descripcion}),c(T,e=>{u.origen=0,e&&(u.origen=e.id)}),c(E,e=>{u.destino=0,e&&(u.destino=e.id)}),c(U,e=>{S.value=e[0]}),c(C,e=>{e?(d.value.producto_id=e.id,d.value.producto=e.nombre):(d.value.producto_id=0,d.value.cantidad=0,d.value.costo=0,d.value.producto="",m.value="",v.value="")}),c(m,e=>{let a=isNaN(Number(e))?0:Number(e),o=isNaN(Number(v.value))?0:Number(v.value);d.value.costo=_(o/a,4),d.value.cantidad=a}),c(v,e=>{let a=isNaN(Number(m.value))?0:Number(m.value),o=isNaN(Number(e))?0:Number(e);d.value.costo=_(o/a,4)});function q(){try{let e=d.value;if(e.producto_id==0)throw"Seleccione un producto.";if(e.cantidad==0)throw"ingrese una cantidad";if(e.costo<=0)throw"ingrese un costo mayor a 0";if(p.value.find(o=>o.producto_id==e.producto_id))throw"El producto ya est\xE1 agregado en el detalle.";p.value.push({producto_id:e.producto_id,cantidad:e.cantidad,costo:e.costo,producto:e.producto,total:Number(_(e.costo*e.cantidad,4))}),C.value=null,v.value="",m.value=""}catch(e){I.error(e,{timeout:1e3})}}c(p.value,e=>{u.detalles=e,B.value=e.reduce((a,{total:o})=>Number(a+o),0),u.total=B.value});function H(e){x.value=!0,d.value.producto_id=e.producto_id,d.value.producto=e.producto,d.value.cantidad=e.cantidad,d.value.costo=e.costo}function M(){x.value=!1}function J(){u.post(route("tenant.almacen.notaingreso.store"),{onSuccess:()=>{console.log("success",u.errors)},onError:()=>{u.errors.detalles&&I.error(u.errors.detalles)}})}function K(e){p.value.splice(e,1)}function Q(){p.value.forEach(e=>{e.producto_id==d.value.producto_id&&(e.total=Number(d.value.costo)*Number(d.value.cantidad),e.costo=Number(d.value.costo),e.cantidad=Number(d.value.cantidad),M())})}return Z(()=>{G()}),(e,a)=>(k(),ee(ae,{title:"Nota Ingreso",titleBread:"Registro nueva nota de ingreso"},{itemBreadCrumb:l(()=>[t(se,{items:["Almacen","Notas de Ingreso","Registrar"],class:"pa-0"})]),default:l(()=>[t(ce,{onSubmit:V(J,["prevent"])},{default:l(()=>[t(de,null,{title:l(()=>[f(" Nota de ingreso ")]),subtitle:l(()=>[f(" Registrar datos de la Nota de Salida: ")]),content:l(()=>[t(w,null,{default:l(()=>[t(r,{cols:"12",md:"3"},{default:l(()=>[t(g,{modelValue:h.value,"onUpdate:modelValue":a[0]||(a[0]=o=>h.value=o),disabled:"",label:"Fecha",variant:"outlined",density:"comfortable",type:"date"},null,8,["modelValue"])]),_:1}),t(r,{cols:"12",md:"3"},{default:l(()=>[t(D,{modelValue:S.value,"onUpdate:modelValue":a[1]||(a[1]=o=>S.value=o),items:U.value,variant:"outlined",density:"comfortable","return-object":"","item-title":"descripcion","item-value":"simbolo",label:"Monedas"},null,8,["modelValue","items"])]),_:1}),t(r,{cols:"12",md:"3"},{default:l(()=>[t(D,{"error-messages":i(u).errors.origen,items:O.value,modelValue:T.value,"onUpdate:modelValue":a[2]||(a[2]=o=>T.value=o),variant:"outlined",density:"comfortable","return-object":"","item-title":"descripcion","item-value":"descripcion",label:"Origen"},null,8,["error-messages","items","modelValue"])]),_:1}),t(r,{cols:"12",md:"3"},{default:l(()=>[t(D,{"error-messages":i(u).errors.destino,items:A.value,modelValue:E.value,"onUpdate:modelValue":a[3]||(a[3]=o=>E.value=o),variant:"outlined",density:"comfortable","return-object":"","item-title":"descripcion","item-value":"descripcion",label:"Destino"},null,8,["error-messages","items","modelValue"])]),_:1})]),_:1}),t(w,null,{default:l(()=>[t(r,{cols:"12",md:"6"},{default:l(()=>[t(ue,{modelValue:C.value,"onUpdate:modelValue":a[4]||(a[4]=o=>C.value=o),items:L.value,"return-object":"","item-value":"id","item-title":"nombre",variant:"outlined",density:"comfortable",label:"Productos"},null,8,["modelValue","items"])]),_:1}),t(r,{cols:"12",md:"2"},{default:l(()=>[t(g,{modelValue:m.value,"onUpdate:modelValue":a[5]||(a[5]=o=>m.value=o),variant:"outlined",density:"comfortable",label:"Cantidad"},null,8,["modelValue"])]),_:1}),t(r,{cols:"12",md:"2"},{default:l(()=>[t(g,{modelValue:v.value,"onUpdate:modelValue":a[6]||(a[6]=o=>v.value=o),variant:"outlined",density:"comfortable",label:"Costo(total)"},null,8,["modelValue"])]),_:1}),t(r,{cols:"12",md:"2"},{default:l(()=>[t(b,{type:"button",block:"",size:"large",color:"info",onClick:q},{default:l(()=>[t(P,{icon:"mdi:mdi-plus"}),f(" Agregar ")]),_:1})]),_:1})]),_:1}),t(w,null,{default:l(()=>[t(r,{cols:"12",md:"12"},{default:l(()=>[t(ne,{density:"comfortable",hover:""},{default:l(()=>[ve,s("tbody",null,[i(p).length>0?(k(!0),F(le,{key:0},oe(i(p),(o,R)=>(k(),F("tr",{key:R},[s("td",pe,[t(b,{color:"blue",onClick:V(W=>H(o),["prevent"]),icon:"mdi:mdi-pencil",size:"x-small",class:"mr-1"},null,8,["onClick"]),t(b,{color:"red",icon:"mdi:mdi-delete",class:"ml-1",onClick:V(W=>K(R),["prevent"]),size:"x-small"},null,8,["onClick"])]),s("td",fe,N(o.cantidad),1),s("td",null,N(o.producto),1),s("td",be,N(i(_)(o.costo,4,!0,i(u).moneda=="SOLES"?"PE":"US")),1),s("td",Ve,N(i(_)(o.total,2,!0,i(u).moneda=="SOLES"?"PE":"US")),1)]))),128)):(k(),F("tr",_e,ye))]),s("tfoot",null,[s("tr",null,[Ne,s("td",Ce,N(i(_)(B.value,2,!0,i(u).moneda=="SOLES"?"PE":"US")),1)])])]),_:1})]),_:1})]),_:1})]),actions:l(()=>[t($,null,{default:l(()=>[t(j),t(b,{onClick:a[7]||(a[7]=V(o=>e.$inertia.visit(e.route("tenant.almacen.notaingreso.index")),["prevent"]))},{default:l(()=>[t(P,{icon:"mdi:mdi-arrow-left"}),f(" Regresar ")]),_:1}),t(b,{type:"submit"},{default:l(()=>[t(P,{icon:"mdi:mdi-content-save"}),f(" Guardar ")]),_:1})]),_:1})]),_:1})]),_:1},8,["onSubmit"]),t(me,{modelValue:x.value,"onUpdate:modelValue":a[11]||(a[11]=o=>x.value=o),"max-width":"450"},{default:l(()=>[t(re,{title:"Editar"},{default:l(()=>[t(ie,null,{default:l(()=>[t(w,null,{default:l(()=>[t(r,{cols:"12",md:"12"},{default:l(()=>[t(g,{disabled:"",modelValue:d.value.producto,"onUpdate:modelValue":a[8]||(a[8]=o=>d.value.producto=o),label:"Producto",density:"comfortable",variant:"outlined"},null,8,["modelValue"])]),_:1}),t(r,{cols:"12",md:"6"},{default:l(()=>[t(g,{modelValue:d.value.cantidad,"onUpdate:modelValue":a[9]||(a[9]=o=>d.value.cantidad=o),label:"Cantidad",density:"comfortable",variant:"outlined"},null,8,["modelValue"])]),_:1}),t(r,{cols:"12",md:"6"},{default:l(()=>[t(g,{label:"Costo U.",modelValue:d.value.costo,"onUpdate:modelValue":a[10]||(a[10]=o=>d.value.costo=o),density:"comfortable",variant:"outlined"},null,8,["modelValue"])]),_:1})]),_:1})]),_:1}),t($,null,{default:l(()=>[t(j),t(b,{onClick:V(M,["prevent"])},{default:l(()=>[f("Cerrar")]),_:1},8,["onClick"]),t(b,{onClick:V(Q,["prevent"])},{default:l(()=>[f("Guardar")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["modelValue"])]),_:1}))}};export{Me as default};