export default class DataTypeUtility {
    
    static SerializedArrayToJSON(serializeArray) {
        var indexed_array = {};

        serializeArray.map(content => {
            indexed_array[content["name"]] = content["value"]
        })

        return indexed_array;
    }

    static DateTimeToDate(dateFormat) {
        // To be implemented
    }
    
}