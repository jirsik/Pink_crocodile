import React, { useState, useEffect } from 'react';
import Nav from './Nav/Nav.jsx';
import Login from './Login/Login.jsx';
import Auction from './Auction/Auction.jsx';
import ContainerBtns from './ContainerBtns/ContainerBtns.jsx';
import ItemsList from './ItemsList/ItemsList.jsx';
import MyBidsList from './MyBidsList/MyBidsList.jsx';

let getItemsInterval

const App = () => {

    /////AUTH//////
    const [token, setToken] = useState(window.localStorage.getItem('_token'))
    const [loggedIn, setLoggedIn] = useState(token ? true : false)
    const [userId, setUserId] = useState(window.localStorage.getItem('_userId')) //Set user_id to local storage!!!!!!!!!!
    /////ITEMS//////
    const [items, setItems] = useState([])
    const [currentItemId, setCurrentItemId] = useState()
    /////DISPLAY//////
    const [display, setDisplay] = useState(loggedIn ? 'show': null)
    // const [display, setDisplay] = useState('show')
    const [infoDisplay, setInfoDisplay] = useState('about')
    const [popularityIndex, setPopularityIndex] = useState([])



    //////////////////////////////////////////////////////
                    // AUTHORISATION //
    ///////////////////////////////////////////////////////

    function getToken (type, input) {

        fetch(`/api/auth/${type}`, {
            method: 'POST',
            withCredentials: true,
            credentials: 'include',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                // 'Authorization': 'Bearer '+ token,
                'Accept' : 'application/json'
            },
            body: input
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('login resonse ',response)
            if(!response.error){
                setToken(response.token)
                window.localStorage.setItem('_token', response.token)
                setUserId(response.user_id)
                window.localStorage.setItem('_userId', response.user_id)
                setLoggedIn(true)
                setDisplay('show')
            }
        })
        .catch((error) => {
            console.log(error)
        })
    }

    function checkToken () {
        fetch(`/api/auth/user`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+ token,
                'Accept' : 'application/json'
            },
        })
        .then((response) => response.json())
        .then((response) => {
            // console.log('response ', response)
        })
    }

    //////////////////////////////////////////////////////
                        // DISPLAY //
    ///////////////////////////////////////////////////////

    const getItems = (url) => {
        fetch(`/api/${url}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+ token,
                'Accept' : 'application/json'
            },
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('RESPONSE: ', response)
            setItems(response)
        })
    }


    const setDisplayTypeBtn = (e) => {
        setDisplay(e.target.id)
    }

    const changeIndex = (e) => {
        if(currentItemId === items.length - 1 && e.target.id === 'next'){
            setCurrentItemId(0)
        }else if(currentItemId === 0 && e.target.id === 'previous'){
            setCurrentItemId(items.length-1)
        }else if(e.target.id === 'previous'){
            setCurrentItemId(i => --i)
        }else if(e.target.id === 'next'){
            setCurrentItemId(i => ++i)
        }

        setInfoDisplay('about')
    }

    const handleShow = (e) => {
        console.log('E: ', e.target.id)
        setCurrentItemId(e.target.id - 1)
        setDisplay('show')
    }

    
    useEffect(() => {
        getItems('landing')
        setCurrentItemId(0)

        // getItemsInterval = setInterval(() => {
        //     getItems('landing')
        // }, 10000)
        // console.log('Items CompDidMount: ',items)
        // return () => {
        //     clearInterval(getItemsInterval)
        // }
    }, [])

    useEffect(() => {
        setPopularityIndex(prevState => {
            const newState = items.slice(0).sort((a,b) => b.bids.length - a.bids.length)
            if(prevState.length === 0){
                return newState
            }else{
                return newState.map(item => {
                    const prevStateIndex = prevState.findIndex(x => x.id === item.id)
                    const newStateIndex = newState.findIndex(x => x.id === item.id)
                    prevStateIndex > newStateIndex ? item.color = 'green' : prevStateIndex < newStateIndex ? item.color = 'red' : item.color = 'black'
                    return item
                })
            }
        })
    }, [items])
    
    
    //////////////////////////////////////////////////////
                        // RETURN //
    ///////////////////////////////////////////////////////
    
    token && checkToken()

    // token && console.log('TOKEN ', token)
        // token && console.log('LOCAL STORAGE: ',window.localStorage.getItem('_token'))
    
    // console.log('USER_ID: ', userId)

    // console.log('ITEMS: ', items)

    return (
        <>
        {<Nav setDisplay={setDisplay} loggedIn={loggedIn} setLoggedIn={setLoggedIn} setDisplay={setDisplay}/>}
        
        <div className="main-container">
            
            <ContainerBtns setDisplayTypeBtn={loggedIn ? setDisplayTypeBtn : null} display={display} />

            <div className="main">
                {
                    display === 'show' && 
                        <div id='previous' className="direction-btn direction-btn_left" onClick={changeIndex} >&lt;</div>
                }
                <div className="display">
                    {!loggedIn && <Login getToken={getToken} />}
                    {display === 'list' && <ItemsList popularityIndex={popularityIndex} handleShow={handleShow}/>}
                    {display === 'show' && items.length > 0 && <Auction item={items[currentItemId]} userId={userId} token={token} getItems={getItems} infoDisplay={infoDisplay} setInfoDisplay={setInfoDisplay}/>}
                    {display === 'myBids' && <MyBidsList items={items} userId={userId} token={token} setCurrentItemId={setCurrentItemId} setDisplay={setDisplay} getItems={getItems} />}
                </div>
                {
                    display === 'show' &&
                        <div id='next' className="direction-btn direction-btn_right" onClick={changeIndex}>&gt;</div>
                }

            </div>
        </div>
        </>
    )
}


export default App;





