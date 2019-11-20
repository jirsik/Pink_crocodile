import React, {useState} from 'react';

const Bid = props => {
    const [price, setPrice] = useState(props.increment)
    const {increment, data, token, setInfoDisplay} = {...props}
    const baseIncrement = props.increment

    const handleOperator = (e) => {
        if(e.target.id === 'plus'){
            console.log('plus')
            setPrice(price + baseIncrement)
        }else if(e.target.id === 'minus'){
            console.log('minus')
            price >= baseIncrement && setPrice(price - baseIncrement)
        }
        console.log('PRICE: ', price)
    }

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
                ...data,
                price
            })
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('bid resonse ',response)
            if(!response.error){
                console.log('BID SUCCESS')
                setInfoDisplay('bidSuccessMessage')
            }
        })
        .catch((error) => {
            console.log(error)
        })
    }

    console.log('JSON STRINGIFY: ',JSON.stringify({
        ...data,
        price: price
    }))

    return (
        <div className="info">
            <div className="info-row bid-row">
                <button className="btn btn-pink operator-btn"><i id="minus" className="fas fa-minus-circle" onClick={handleOperator}></i></button>
                <input className="bid-amount" type="number" placeholder={price} />
                <button className="btn btn-pink operator-btn"><i id="plus" className="fas fa-plus-circle" onClick={handleOperator}></i></button>
            </div>
            <div className="submit-btns">
                <div className="btn btn-success" onClick={submitBid}>Submit Bid</div>
            </div>
        </div>
    )
}

export default Bid;