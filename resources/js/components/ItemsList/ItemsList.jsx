import React, { useEffect } from 'react';
import calculateRemainingTime from '../../helpers/calculateRemainingTime.js'

const ItemsList = props => {
    let items = props.items
    const handleShow = props.handleShow

    items = items.map( item => ({
        id: item.id,
        starts_at: item.starts_at,
        ends_at: item.ends_at,
        price: item.minimum_price,
        info: item.item
    }))
    
    // console.log('Items List :', items)

    return (
        <div className="items-list">
        {items.length && items.map((item) => (

            <div className="item">
                <div className="item-title">{item.info.title}</div>
                {/* <div>{item.info.description}</div> */}
                <div className="item-time-list">{calculateRemainingTime(item.starts_at, item.ends_at)}</div>
                <div className="price-popularity-row">
                    <div className="price-popularity-row--icons">
                        <i className="fas fa-chart-line bids-icon"></i>
                        {/* <i className="fas fa-arrow-up popularity-icon"></i> */}
                        <i className="far fa-arrow-alt-circle-up popularity-icon"></i>
                    </div>
                    <div>{item.price} <strong>CZK</strong></div>
                </div>
                <div id={item.id} className="item-show-btn btn-primary btn" onClick={handleShow}>See Item</div>
            </div>

        ))}
        </div>
        
    )
}

export default ItemsList;