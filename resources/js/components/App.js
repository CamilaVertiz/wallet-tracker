import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TransferForm from './TransferForm';
import TransferList from './TransferList';
import Error from './Error';
import url from './url';

export class App extends Component{

    constructor(props){
        super(props)
        this.state = {
            money: 0.0,
            transfers: [],
            error: null,
            form:{
                description: '',
                amount: '',
                wallet_id: 1
            },
            message: undefined,
        }

        this.handleChange = this.handleChange.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.handleOnClick = this.handleOnClick.bind(this)
        this.clearMessage = this.clearMessage.bind(this)
    }

    async handleSubmit(e){
        e.preventDefault()
        try {
            let config = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(this.state.form)
            }

            let res = await fetch(`${url}/api/transfer`, config)
            let data = await res.json()

            this.setState({
                transfers: this.state.transfers.concat(data),
                money: this.state.money + (parseInt(data.amount))
            })
        } catch (error) {
            
        }
    }

    handleChange(e){
        this.setState({
             form:{
                ...this.state.form,
                [e.target.name]: e.target.value,
             }
        })
    }

    async handleOnClick(e){
        const id = e.currentTarget.dataset.value;

        try {
            let config = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({id: id})
            }

            let res = await fetch(`${url}/api/delete`, config)
            let data = await res.json()
            console.log(data.transfers);
            this.setState({
                money: parseInt(data.money), 
                message: data.message,
                transfers: data.transfers
            })
        } catch (error) {
            
        }
    }

    async componentDidMount(){
        try {
            let res = await fetch(`${url}/api/wallet`)
            let data = await res.json()
            this.setState({
                money: data.money,
                transfers: data.transfers
            })
        } catch (error) {
            
        }
    }

    clearMessage(e){
        this.setState({
             message: undefined,
        })
    }

    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12-m-t-md">
                        <p className="title"> $ {this.state.money} </p>                        
                    </div>
                    <div className="col-md-12">
                        <TransferForm form={this.state.form} onChange={this.handleChange} onSubmit={this.handleSubmit} />
                    </div>
                </div>
                {this.state.message && (<Error message={this.state.message} clearError={this.clearMessage}/>)}
                <div className="m-t-md">
                    <TransferList transfers={this.state.transfers} onClick={this.handleOnClick} />
                </div>
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}