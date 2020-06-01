export default {
    data() {
        return {
            paginatePage: 1,
            paginateShow: 5,
            paginateTag: 'items'
        }
    },
    computed: {
        paginateItems() {
            let start = (this.paginatePage - 1) * this.paginateShow;
            return this[this.paginateTag].slice(start, start + this.paginateShow)
        },
        paginateTotalPages() {
            return Math.ceil(this[this.paginateTag].length / this.paginateShow);
        }
    }
}