<template id="monhoc-edit">
    <div class="row">
        <h1>Edit Page</h1>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                vail: false,
                monhoc: {
                    id: '',
                    tenmonhoc: '',
                    ngaybatdau: '',
                    ngayketthuc: '',
                    menubatdau: false,
                    getMenuketthuc: false,
                },
            };
        },
        created() {

        },
        methods: {},
        computed: {}
    }
</script>