import{l as k,h as w,m as x,b as s,o as d,g as b,p as y,u as v,c,w as m,a as t,H as V,t as $,k as u,d as r,L as B,e as p,n as C,f as L}from"./app.aad8aba1.js";import{_ as N,a as R}from"./PrimaryButton.74331d50.js";import{_ as f,a as _,b as g}from"./TextInput.e8d52864.js";import"./ApplicationLogo.423f1d4d.js";const S=["value"],U={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(l,{emit:e}){const i=l,n=k({get(){return i.checked},set(a){e("update:checked",a)}});return(a,o)=>w((d(),b("input",{type:"checkbox",value:l.value,"onUpdate:modelValue":o[0]||(o[0]=h=>y(n)?n.value=h:null),class:"rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"},null,8,S)),[[x,s(n)]])}},q={key:0,class:"mb-4 font-medium text-sm text-green-600"},F=["onSubmit"],P={class:"mt-4"},D={class:"block mt-4"},E={class:"flex items-center"},H=r("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),M={class:"flex items-center justify-end mt-4"},G={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const e=v({email:"",password:"",remember:!1}),i=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(n,a)=>(d(),c(N,null,{default:m(()=>[t(s(V),{title:"Log in"}),l.status?(d(),b("div",q,$(l.status),1)):u("",!0),r("form",{onSubmit:L(i,["prevent"])},[r("div",null,[t(f,{for:"email",value:"Email"}),t(_,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[0]||(a[0]=o=>s(e).email=o),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(g,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),r("div",P,[t(f,{for:"password",value:"Password"}),t(_,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[1]||(a[1]=o=>s(e).password=o),required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(g,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),r("div",D,[r("label",E,[t(U,{name:"remember",checked:s(e).remember,"onUpdate:checked":a[2]||(a[2]=o=>s(e).remember=o)},null,8,["checked"]),H])]),r("div",M,[l.canResetPassword?(d(),c(s(B),{key:0,href:n.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900"},{default:m(()=>[p(" Forgot your password? ")]),_:1},8,["href"])):u("",!0),t(R,{class:C(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[p(" Log in ")]),_:1},8,["class","disabled"])])],40,F)]),_:1}))}};export{G as default};
