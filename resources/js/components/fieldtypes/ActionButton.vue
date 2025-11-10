<template>
    <div style="background: red; padding: 20px; color: white; font-weight: bold;">
        <div>HELLO</div>
        <div>Value is here</div>
        <a href="#" style="color: yellow;">Click me</a>
    </div>
</template>

<script>
export default {
    mixins: [Fieldtype],

    mounted() {
        console.log('ActionButton mounted', { value: this.value, config: this.config });
    }
};
</script>
