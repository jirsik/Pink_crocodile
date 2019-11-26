const calculateBidIncrement = (currentPrice) => {
    if(currentPrice < 150){
        return 10
    }else if(currentPrice < 200){
        return 20
    }else if(currentPrice < 300){
        return 30
    }else if(currentPrice < 400){
        return 40
    }else if(currentPrice < 500){
        return 50
    }else{
        return 100
    }
}

export default calculateBidIncrement