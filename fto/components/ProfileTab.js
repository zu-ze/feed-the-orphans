import React, { memo } from 'react';
import {View, Text} from 'react-native';
import { Button } from 'react-native-paper';
import { styles } from '../core/Theme';

const ProfileTab = ({ name, district, showMap, donate}) => {
    return (
        <View 
            style={
                [
                    
                    { 
                        // backgroundColor: "#4b88a288", 
                        flexDirection: "column", 
                        justifyContent: "flex-end",
                        alignItems: "center",
                        paddingTop: 10,
                        width: "98%",
                        height: 320

                    }
                ]
            }
    >
        <View 
            style={
                [
                    styles.box, 
                    {
                        backgroundColor: "#4b88a2", 
                        borderRadius: 100,
                        borderColor: "white",
                        borderWidth: 10, 
                        width: 200,
                        height: 200, 
                        position: "absolute", 
                        top: 2.5,
                        zIndex: 10
                    }
                ]
            }
        >
        </View>
        <View style={
                [
                    styles.box, 
                    {
                        backgroundColor: "#4b88a288",
                        width: "98%",
                        height: 200,
                        paddingTop: 100,
                    }
                ]
            } 
        >
            <View>
                <Text style={{fontSize: 18}} >{name}</Text>
                <Text style={{fontSize: 14}} >{district}</Text>
                <Button onPress={() => {
                    donate()
                }} >Donate</Button>
                <Button onPress={() => {
                    showMap();
                }} >Map</Button>
            </View>
        </View>
    </View>
    )
}

export default memo(ProfileTab);