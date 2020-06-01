export default class Paginator {

    /**
     * 
     * @param {array} data 
     * @param {number} show numero de items por pagina 
     */
    constructor(data = [], show = 5) {
        this.data = data;
        this.show = show;
        this.page = 1;
    }

    get items() {
        return this.data.slice(this.show * (this.page - 1), this.show * this.page);
    }

    get lastPage() {
        return Math.ceil(this.data.length / this.show);
    }
}