import React from 'react';

const Info = props => {
    const info = props.info
    console.log(props)

    return (
        <div className="info">
            <div className="info-row">
                <i className="fas fa-info-circle about-icon"></i>
                <p>{info.description}</p>
            </div>
            <div className="info-row">
                <i className="fas fa-gavel highest-bidder-icon"></i>
                <p>Isaac Sackler</p>
            </div>
            <div className="info-row">
                <i className="fas fa-chart-line bids-icon"></i>
                <p>3rd / 12</p>
            </div>
            <div className="info-row">
                <i className="fas fa-hand-holding-heart donor-icon"></i>
                <div>
                    <p>{info.donor.name}</p>
                    <a href={info.donor.link}>donor.org</a>
                </div>
            </div>
        </div>
    )
}

export default Info;