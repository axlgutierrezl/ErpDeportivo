import{h as u,s as k,c as C,w as a,z as b,o as i,b as o,q as V,k as y,a as t,f as m,l as w,t as n,F as B}from"./app.50683a97.js";import{T as D}from"./TenantLayout.4c67b316.js";import{C as T}from"./CardView.5dc7dcb1.js";import{_ as A}from"./AddEditCategoria.39774cac.js";import{V as E}from"./VBreadcrumbs.c34b1911.js";import{V as p,g as L}from"./index.4549214f.js";import{V as N}from"./VTable.b15a6983.js";import"./_plugin-vue_export-helper.cdc0426e.js";import"./VNavigationDrawer.8088819a.js";import"./DialogFormModal.e18ee1c1.js";import"./VForm.9f532f63.js";import"./VTextField.65545f13.js";import"./VDialog.52eddf4b.js";const I=t("thead",{class:"text-uppercase bg-thead-primary"},[t("tr",null,[t("th",{class:"text-center"},"Nombre"),t("th",{class:"text-center"},"Fecha creaci\xF3n"),t("th",{class:"text-center"},"N\xB0 Productos"),t("th",{class:"text-center"},"estado"),t("th",{class:"text-center"},"Acciones")])],-1),$={class:"text-center"},z={class:"text-center"},F={class:"text-center"},M={class:"text-center"},S={class:"text-center"},U={key:1},q=t("td",{colspan:"4",class:"text-center"},[t("strong",null,"No hay registros")],-1),P=[q],et={__name:"CategoriaIndex",props:["flash","categorias"],setup(h){const g=h,r=u(!1),l=u([]),c=u({id:0,descripcion:""});function d(_,s={}){switch(_){case"ADD":{r.value=!0;break}case"EDIT":{r.value=!0,c.value.id=s.id,c.value.descripcion=s.descripcion;break}}}function f(){b.Inertia.reload({only:["categorias"],onSuccess:()=>{l.value=g.categorias}})}return k(()=>{f()}),(_,s)=>(i(),C(D,{title:"Categorias",titleBread:"Listado de categorias"},{itemBreadCrumb:a(()=>[o(E,{items:["Almacen","Categorias","Lista"],class:"pa-0"})]),default:a(()=>[o(T,null,{title:a(()=>[o(p,{class:"float-right",color:"teal-darken-2",onClick:s[0]||(s[0]=V(e=>d("ADD"),["prevent"]))},{default:a(()=>[o(L,{icon:"mdi:mdi-plus"}),y(" Agregar ")]),_:1})]),content:a(()=>[o(N,{density:"comfortable",hover:""},{default:a(()=>[I,t("tbody",null,[l.value.length>0?(i(!0),m(B,{key:0},w(l.value,(e,x)=>(i(),m("tr",{key:x},[t("td",$,n(e.descripcion),1),t("td",z,n(e.fecha_creacion),1),t("td",F,n(e.total_productos),1),t("td",M,n(e.estado),1),t("td",S,[o(p,{onClick:v=>d("EDIT",e),icon:"mdi:mdi-pencil",color:"success",size:"x-small",class:"mr-1"},null,8,["onClick"]),o(p,{onClick:v=>d("DELETE",e),icon:"mdi:mdi-delete",color:"red",size:"x-small",class:"ml-1"},null,8,["onClick"])])]))),128)):(i(),m("tr",U,P))])]),_:1})]),_:1}),o(A,{show:r.value,"onUpdate:show":s[1]||(s[1]=e=>r.value=e),formulario:c.value,"onUpdate:formulario":s[2]||(s[2]=e=>c.value=e),onAddingCategoria:f},null,8,["show","formulario"])]),_:1}))}};export{et as default};