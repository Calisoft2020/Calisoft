import _ from 'lodash';

export default {
    methods: {
        /**
         * 
         * @param {any[]} items 
         * @param {string} query 
         * @param {string[]} by 
         */
        searchBy(items, query, ...by) {
            return items.filter(item => {
                let entry = _(item).pick(by).values().join(' ')
                return new RegExp(query, 'ig').test(entry)
            })
        }
    }
}