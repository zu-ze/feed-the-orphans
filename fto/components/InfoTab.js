import React, { memo } from 'react';
import {View, Text, FlatList, useWindowDimensions } from 'react-native';
import { Paragraph } from 'react-native-paper';
import { styles } from '../core/Theme';
import HTML from 'react-native-render-html';

const InfoTab = ({title, text}) => {
    const contentWidth = useWindowDimensions().width;

    return (
          <View
            style={
              [
                styles.container, 
                {
                  flexDirection: "column", 
                  justifyContent: "flex-start", 
                  borderRadius: 5, 
                  marginTop: 10,
                  backgroundColor: "#4b88a2", 
                  width: "98%" 
                }
              ]
            }
          >
            {/* ######################## */}
            <View  
              style={
                { 
                  backgroundColor: "white", 
                  position: "absolute",
                  top: 0,
                  zIndex: 2,
                  padding: 10, 
                  width: '90%', 
                  borderRadius: 5 
                }
              }
            >
              <Text style={{fontSize: 18}} >{title}</Text>
            </View>
            {/* ######################## */}

            {/* ######################## */}
            <View style={{ marginTop: 10, paddingVertical: 40, width: '90%'}} >
              <Paragraph>
                <HTML source={{ html: text }} contentWidth={contentWidth} />
              </Paragraph>
            </View>
            {/* ######################## */}
          </View>
    )
}

export default memo(InfoTab);