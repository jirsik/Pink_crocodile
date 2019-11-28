function formatNumber(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

console.log(formatNumber(4321))

export default formatNumber;