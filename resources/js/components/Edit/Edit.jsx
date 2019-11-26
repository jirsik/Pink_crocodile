import React, {useState} from 'react';

const Edit = props => {
    const {user, token} = {...props}
    const [formInputValues, setFormInputValues] = useState({email: user.email, password: '', first_name: user.first_name, last_name: user.last_name, id: user.id})
    const [showSuccessMessage, setShowSuccessMessage] = useState(false);

    ////////////////////////////////////
                //API CALL//
    ///////////////////////////////////

    function editUser (input) {

        fetch(`/api/auth/edit`, {
            method: 'POST',
            withCredentials: true,
            credentials: 'include',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+ token,
                'Accept' : 'application/json'
            },
            body: input
        })
        .then((response) => response.json())
        .then((response) => {
            console.log('edit resonse ',response)
            setShowSuccessMessage(true)
        })
        .catch((error) => {
            console.log(error)
        })
    }

    ////////////////////////////////////////
                //HANDLERS//
    ////////////////////////////////////////

    const handleInputChange = (e) => {
        setFormInputValues({
            ...formInputValues,
            [e.target.id]:e.target.value
        })
    }

    const handleSubmitButton = (e) => {
        e.preventDefault()

        editUser(JSON.stringify({...formInputValues}))
    }

    ///////////////////////////////////////
                //RETURN//
    ///////////////////////////////////////

    const successMessage = (
        <div style={{border: '1px solid green', padding: '0.5rem'}}>Your details have been updated</div>
    )

    console.log('USER: ',user)

    return (

        <div className="login-display">


            <form className="login-form">
                <div className="logo-img"/>
                <label htmlFor="email">Email</label>
                <input
                    id="email"
                    type="email"
                    placeholder="Email"
                    value={formInputValues.email}
                    onChange={handleInputChange}
                />
                <label htmlFor="password">Password</label>
                <input
                    id="password"
                    type="password"
                    placeholder="Password"
                    value={formInputValues.password}
                    onChange={handleInputChange}
                />         
                <label htmlFor="password">Confirm Password</label>
                <input
                    id="confirm"
                    type="password"
                    placeholder="Confirm Password"
                    value=''
                    onChange={handleInputChange}
                />         
                <label htmlFor="first_name">First Name</label>
                <input
                    id="first_name"
                    type="string"
                    placeholder="First Name"
                    value={formInputValues.first_name}
                    onChange={handleInputChange}
                />
                <label htmlFor="last_name">Last Name</label>
                <input
                    id="last_name"
                    type="string"
                    placeholder="Last Name"
                    value={formInputValues.last_name}
                    onChange={handleInputChange}
                />
            </form>

            {showSuccessMessage && successMessage}

            <div className="form-btn-container" style={{justifyContent:'center'}}>
                <button className="btn-warning btn btn-main" onClick={handleSubmitButton} style={{width: '90%'}}>Submit Changes</button>
            </div>

        </div>

    )
}

export default Edit;