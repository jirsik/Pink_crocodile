import React, {useState} from 'react'
import calculateBidIncrement from '../../helpers/calculateBidIncrement'

const Bid = props => {

    ////////PROPS////////////
    const {bidData, token, setInfoDisplay, getItems} = {...props}

    ///////PRICING///////////
    const currentPrice = bidData.current_price
    const baseIncrement = calculateBidIncrement(currentPrice)
    const [price, setPrice] = useState(currentPrice + baseIncrement)
    const [disabled, setDisabled] = useState(false)

    const handleOperator = (e) => {
        // console.log('PRICE CALC: ', price + baseIncrement)
        // console.log('PRICE: ', price)
        if(e.target.id === 'plus'){
            setPrice(price + baseIncrement)
        }else if(e.target.id === 'minus' && price >= currentPrice + baseIncrement*2){
            setPrice(price - baseIncrement)
        }
    }

     //////////////////////////////////////////////////////
                    // SUBMIT BID //
    ///////////////////////////////////////////////////////

    const submitBid = () => {
        setDisabled(true)
        console.log('DISABLED')
        
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
                getItems('landing')
                setInfoDisplay('bidSuccessMessage')
                setTimeout(() => {setInfoDisplay('about')}, 3000)
                setTimeout(() => {setDisabled(false)}, 5000)
                console.log('ENABLED')
            }else{
                setInfoDisplay('bidFailedMessage')
                setTimeout(() => {setInfoDisplay('about')}, 3000)
            }
        })
        .catch((error) => {
            console.log(error)
        })
        
        //Refresh items
        // getItems('landing')
    }

    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////

    // console.log('BID DATA: ', bidData)

    return (
        <div className="info">
            <div className="info-row bid-row">
                <button className="btn btn-pink operator-btn" ><i id="minus" className="fas fa-minus-circle" onClick={handleOperator}></i></button>
                <div className="bid-amount" type="number">{price}</div>
                <button className="btn btn-pink operator-btn"><i id="plus" className="fas fa-plus-circle" onClick={handleOperator}></i></button>
            </div>
            <div className="submit-btns">
                <button disabled={disabled} className="btn btn-success submit-bid-btn" onClick={submitBid}>Submit Bid</button>
            </div>
        </div>
    )
}

export default Bid;