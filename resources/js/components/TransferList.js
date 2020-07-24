import React from 'react';
import axios from 'axios';
import url from './url';

const TransferList = ({transfers, onClick}) =>{

    return(        
        <table className="table">
            <tbody>
                { transfers.map((transfer)=>(
                    <tr key={transfer.id}>
                        <td>{transfer.description}</td>
                        <td className= {transfer.amount > 0 ? 'text-success text-right' : 'text-danger text-right'}>{transfer.amount}</td> 
                        <td className='text-danger delete'><a onClick={onClick} data-value={transfer.id}><span><i className="fa fa-times"></i></span></a></td>                         
                    </tr>
                ))}               
            </tbody>
        </table>
    )
}

export default TransferList;