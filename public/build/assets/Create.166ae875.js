import{T as D}from"./TenantLayout.4c67b316.js";import{C as R}from"./CardView.5dc7dcb1.js";import{h as p,p as h,s as M,o as f,c as B,w as t,b as e,a,f as g,F as U,l as $,n as I,t as m,u as x,q as E,k as y,i as L,aS as j}from"./app.50683a97.js";import{_ as q}from"./Pagination.d3bb47b6.js";import{F as P}from"./helpers.09edc9ed.js";import{b as z,a as A,p as O,h as G}from"./VNavigationDrawer.8088819a.js";import{a as v,b as u,V as H}from"./index.4549214f.js";import{V as w}from"./VTextField.65545f13.js";import{V as J}from"./VTable.b15a6983.js";import{V as K}from"./VDialog.52eddf4b.js";import{V as Q}from"./VBreadcrumbs.c34b1911.js";import{V as S}from"./VSelect.1e68f7fa.js";import{V as W}from"./VTextarea.d8f411ef.js";import{V as X}from"./VForm.9f532f63.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./VCheckboxBtn.fafb4134.js";import"./VChip.0d8836c3.js";const Y=a("thead",{class:"text-uppercase bg-thead-primary text-center"},[a("tr",null,[a("th",null,"Producto"),a("th",null,"UM"),a("th",null,"Cantidad"),a("th",null,"Cod. Barra"),a("th",null,"P. Venta"),a("th",null,"P. Compra")])],-1),Z=["onClick","onDblclick"],ee={class:"text-center"},te={class:"text-center"},ae={class:"text-center"},oe={class:"text-center"},le={class:"text-center"},se={key:1},re=a("td",{colspan:"6",class:"text-center"},[a("strong",null,"No hay registros")],-1),ne=[re],de={__name:"ProductoModal",props:{show:{type:Boolean,default:!1}},emits:["update:show","SelectedProduct"],setup(C,{emit:d}){const s=p(1),r=p(""),n=p([]),i=p(null),_=p(null);async function b(){try{_.value=null;const{data:l}=await j.get(route("tenant.almacen.productos.getProductos"),{params:{page:s.value,search:r.value}});i.value=l}catch{}}h(s,b),h(r,()=>{s.value=1,b()}),h(i,l=>{n.value=l.data});function k(l=!0){s.value=1,r.value="",l&&d("update:show",!1),_.value=null}function N(l){_.value=Number(l)}function F(l){d("SelectedProduct",l),k(!1)}return M(()=>{b()}),(l,c)=>(f(),B(K,{modelValue:C.show,"onUpdate:modelValue":c[2]||(c[2]=o=>L(show)?show.value=o:null),"max-width":"1200"},{default:t(()=>[e(z,{subtitle:"Instrucciones: Doble click en el registro del producto."},{default:t(()=>[e(A,null,{default:t(()=>[e(v,null,{default:t(()=>[e(u,null,{default:t(()=>[e(w,{modelValue:r.value,"onUpdate:modelValue":c[0]||(c[0]=o=>r.value=o),label:"Busqueda",variant:"outlined",density:"comfortable"},null,8,["modelValue"])]),_:1})]),_:1}),e(v,null,{default:t(()=>[e(u,{cols:"12",md:"12"},{default:t(()=>[e(J,{density:"comfortable"},{default:t(()=>[Y,a("tbody",null,[n.value.length>0?(f(!0),g(U,{key:0},$(n.value,(o,V)=>(f(),g("tr",{key:V,onClick:T=>N(V),class:I(V==_.value?"bg-purple-darken-1":""),onDblclick:T=>F(o)},[a("td",null,m(o.nombre),1),a("td",ee,m(o.unidad_medida),1),a("td",te,m(o.stock),1),a("td",ae,m(o.codigo_barra),1),a("td",oe,m(x(P)(o.precio_venta,2,!0,"PE")),1),a("td",le,m(x(P)(o.precio_compra,2,!0,"PE")),1)],42,Z))),128)):(f(),g("tr",se,ne))])]),_:1}),e(q,{paginate:i.value,page:s.value,"onUpdate:page":c[1]||(c[1]=o=>s.value=o)},null,8,["paginate","page"])]),_:1})]),_:1})]),_:1}),e(O,null,{default:t(()=>[e(G),e(H,{onClick:E(k,["prevent"])},{default:t(()=>[y("Cerrar")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1},8,["modelValue"]))}},Pe={__name:"Create",setup(C){const d=p(!1);function s(r){console.log(r)}return(r,n)=>(f(),B(D,{title:"Nota Ingreso",titleBread:"Registro de notas de salida"},{itemBreadCrumb:t(()=>[e(Q,{items:["Almacen","Nota Salida","Registrar"],class:"pa-0"})]),default:t(()=>[e(X,null,{default:t(()=>[e(R,null,{title:t(()=>[y(" Nota de Salida ")]),subtitle:t(()=>[y(" Registrar datos de la Nota de Ingreso : ")]),content:t(()=>[e(v,null,{default:t(()=>[e(u,{cols:"12",md:"3"},{default:t(()=>[e(w,{disabled:"",label:"Fecha",variant:"outlined",density:"comfortable",type:"date"})]),_:1}),e(u,{cols:"12",md:"3"},{default:t(()=>[e(S,{variant:"outlined",density:"comfortable","return-object":"","item-title":"descripcion","item-value":"descripcion",label:"Origen"})]),_:1}),e(u,{cols:"12",md:"3"},{default:t(()=>[e(S,{variant:"outlined",density:"comfortable","return-object":"","item-title":"descripcion","item-value":"descripcion",label:"Destino"})]),_:1}),e(u,{cols:"12",md:"3"},{default:t(()=>[e(W,{variant:"outlined",rows:"2",density:"comfortable","no-resize":""})]),_:1})]),_:1}),e(v,null,{default:t(()=>[e(u,{cols:"12",md:"6"},{default:t(()=>[e(w,{"onClick:append":n[0]||(n[0]=i=>d.value=!d.value),label:"Producto",density:"comfortable",variant:"outlined","append-icon":"mdi:mdi-magnify"})]),_:1})]),_:1})]),_:1})]),_:1}),e(de,{show:d.value,"onUpdate:show":n[1]||(n[1]=i=>d.value=i),onSelectedProduct:s},null,8,["show"])]),_:1}))}};export{Pe as default};
