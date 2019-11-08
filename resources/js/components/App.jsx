import React from 'react';

export default class App extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            token: null,
            logged_in: null
        }
    }

    render() {

        return (
            <main>
                <h1>Pink Croc Auction</h1>
            </main>
        )
    }
}