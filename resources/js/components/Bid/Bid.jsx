import React, {useState} from 'react';

const Bid = props => {

    ////////PROPS////////////
    const {bidData, token, setInfoDisplay, getItems} = {...props}
    
    ///////PRICING///////////
    const baseIncrement = Math.ceil(bidData.current_price / 100) * 10

    const [price, setPrice] = useState(bidData.current_price)

    const handleOperator = (e) => {
        if(e.target.id === 'plus'){
            setPrice(price + baseIncrement)
        }else if(e.target.id === 'minus'){
            price >= baseIncrement && setPrice(price - baseIncrement)
        }
        // console.log('PRICE: ', price)
    }

    const handlePriceChange = (e) => {
        setPrice(e.target.value)
        // console.log('SET PRICE: ', price)
    }

     //////////////////////////////////////////////////////
                    // SUBMIT BID //
    ///////////////////////////////////////////////////////

    const submitBid = () => {
        console.log('SUBMIT BID: ')
        fetch(`/api/auth/bid`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+ token,
                'Accept' : 'application/json'
            },
            body: JSON.stringify({
                ...bidData,
                price
            })
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('bid resonse ',response)
            if(response.submit === true){
                setInfoDisplay('bidSuccessMessage')
                setTimeout(() => {setInfoDisplay('about')}, 3000)
            }else{
                setInfoDisplay('bidFailedMessage')
            }
        })
        .catch((error) => {
            console.log(error)
        })
        
        //Refresh items
        getItems('landing')
    }

    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////

    return (
        <div className="info">
            <div className="info-row bid-row">
                <button className="btn btn-pink operator-btn"><i id="minus" className="fas fa-minus-circle" onClick={handleOperator}></i></button>
                <input className="bid-amount" type="number" placeholder={`Next Bid:     ${price}`} onChange={handlePriceChange}/>
                <button className="btn btn-pink operator-btn"><i id="plus" className="fas fa-plus-circle" onClick={handleOperator}></i></button>
            </div>
            <div className="submit-btns">
                <div className="btn btn-success" onClick={submitBid}>Submit Bid</div>
            </div>
        </div>
    )
}

export default Bid;