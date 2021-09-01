<template>
    <header>
        <router-link :to="{name : 'home'}">Home</router-link>
        <router-link :to="{name : 'single', params : {slug : 'foo-bar'}}">Single</router-link>
    </header>
</template>