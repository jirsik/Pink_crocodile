const calculateBidIncrement = (currentPrice) => {
    if(currentPrice < 100){
        return 10
    }else if(currentPrice < 500){
        return 20
    }else if(currentPrice < 1000){
        return 50
    }else if(currentPrice < 2000){
        return 100
    }else if(currentPrice < 5000){
        return 200
    }else if(currentPrice < 10000){
        return 500
    }
}

export default calculateBidIncrement